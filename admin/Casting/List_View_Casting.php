<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 20/09/2015
 * Time: 09:53
 */


require_once(ABSPATH . 'wp-admin/includes/template.php' );

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}


class List_View_Casting extends WP_List_Table{

    function __construct() {
        parent::__construct( array(
                'singular'=> 'Lieu de casting',
                'plural' => 'Lieux de casting',
                'ajax' => true,
                'screen' => null
            ) );
    }


    /**
     * [REQUIRED] this is a default column renderer
     *
     * @param $item - row (key, value array)
     * @param $column_name - string (key)
     * @return HTML
     */
    function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    function column_ville($item)
    {
        global $wpdb;
        $table_name = $wpdb->prefix. 'miss_ville';
        $libelle = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $item['ville']), ARRAY_A);

        return sprintf('%s ',$libelle['ville']
        );
    }

    function column_datelieu($item)
    {
        return sprintf('%s',
            ''.$item['datelieu'].''
        );
    }

    function column_heure($item)
    {
        return sprintf('%s',
            ''.$item['heure'].''
        );
    }

    function column_lieu($item)
    {
        $menu_page = menu_page_url(PREFIX_PLUGINS_NAME."_add_casting", false );

        $menu_page_casting = menu_page_url(PREFIX_PLUGINS_NAME."_casting", false );
        $actions = array();
        if($item['passe'] == 0 || empty($item['passe'])){
            $actions['create'] = sprintf('<a href="' .$menu_page_casting. '&passe=%s"">%s</a>',$item["id"], 'Evenement Passé' );
        }else{
            $actions['create'] = sprintf('<a href="' .$menu_page_casting. '&passe=%s"">%s</a>',$item["id"], 'Relancer le lieu de l\'evenement' );
        }
        return sprintf('%s %s',
            '<a href="'.$menu_page.'&id='.$item["id"].'">'.$item['lieu'].'</a>',
            $this->row_actions($actions)
        );
    }

    function column_etape($item)
    {
        global $wpdb;
        $table_phase = $wpdb->prefix. 'miss_phase';
        $phase = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_phase WHERE etape = %d", $item['etape']), ARRAY_A);
        return sprintf('%s',
            ''.$phase['valeur'].''
        );
    }

    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'cb' => array('cb', true),
            'lieu' => array('lieu', false),
            'datelieu' => array('datelieu', true),
            'heure' => array('heure', true),
            'ville' => array('ville', true),
            'etape' => array('etape', false),
        );
        return $sortable_columns;
    }

    /**
     * [REQUIRED] This method return columns to display in table
     * you can skip columns that you do not want to show
     * like content, or description
     *
     * @return array
     */
    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'lieu' => 'lieu',
            'datelieu' => 'date',
            'heure' => 'heure',
            'ville' => 'ville',
            'etape' => 'Phase'
        );
        return $columns;
    }


    /**
     * [OPTIONAL] Return array of bult actions if has any
     *
     * @return array
     */
    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'miss_lieu';

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
    }

    function prepare_items() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'miss_lieu';

        $per_page = 25;

        $columns = self::get_columns();
        $hidden = array();
        $sortable = self::get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();

        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys(self::get_sortable_columns()))) ? $_REQUEST['orderby'] : 'ville';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';

        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array


        // will be used in pagination settings
        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name ");
        $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, ($paged*$per_page)), ARRAY_A);



        // [REQUIRED] configure pagination
        self::set_pagination_args(array(
                'total_items' => $total_items, // total items defined above
                'per_page' => $per_page, // per page constant defined at top of method
                'total_pages' => ceil($total_items / $per_page) // calculate pages count
            ));
    }

}