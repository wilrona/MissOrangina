<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 18/10/2015
 * Time: 12:56
 */

require_once(ABSPATH . 'wp-admin/includes/template.php' );

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class List_View_Ville extends WP_List_Table{
    function __construct() {
        parent::__construct( array(
                'singular'=> 'Ville de concours',
                'plural' => 'Villes de concours',
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
        $menu_page = menu_page_url(PREFIX_PLUGINS_NAME."_add_ville", false );

        return sprintf('%s ', '<a href="'.$menu_page.'&id='.$item["id"].'">'.$item['ville'].'</a>'
        );
    }

    function column_abreviation($item)
    {

        return sprintf('%s ', $item['abreviation']
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
            'ville' => array('ville', false),
            'abreviation' => array('abreviation', false),
        );
        return $sortable_columns;
    }

    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'ville' => 'Nom de la ville',
            'abreviation' => 'Abreviation'
        );
        return $columns;
    }

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
        $table_name = $wpdb->prefix . 'miss_ville';
        $table_lieu = $wpdb->prefix . 'miss_lieu';
        $table_inscrit = $wpdb->prefix . 'miss_inscrit';

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            $used = false;
            if(is_array($ids)){
                $idIn = $ids;
                $ids = implode(',', $ids);
                foreach ($idIn as $id) {
                    $count_lieu = $wpdb->get_var("SELECT COUNT(*) FROM $table_lieu WHERE ville IN ($id)");
                    $count_inscrit = $wpdb->get_var("SELECT COUNT(*) FROM $table_inscrit WHERE ville IN ($id)");

                    if($count_inscrit || $count_lieu){
                        $used = true;
                    }

                }

            }else{
                $count_lieu = $wpdb->get_var("SELECT COUNT(*) FROM $table_lieu WHERE ville IN ($ids)");
                $count_inscrit = $wpdb->get_var("SELECT COUNT(*) FROM $table_inscrit WHERE ville IN ($ids)");

                if($count_inscrit || $count_lieu){
                    $used = true;
                }
            }

//            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids) && $used == false) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
    }

    function prepare_items($search = NULL) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'miss_ville';

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

        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array
        if(!empty($search)){
            $search = trim($search);
            // will be used in pagination settings
            $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name WHERE ville LIKE '%".$search."%'");
            $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE ville LIKE '%%%s%%' ORDER BY $orderby $order LIMIT %d OFFSET %d", $search, $per_page, ($paged*$per_page)), ARRAY_A);

        }else {
            // will be used in pagination settings
            $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name ");
            $this->items = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d",
                    $per_page,
                    ($paged * $per_page)
                ),
                ARRAY_A
            );
        }


        // [REQUIRED] configure pagination
        self::set_pagination_args(array(
                'total_items' => $total_items, // total items defined above
                'per_page' => $per_page, // per page constant defined at top of method
                'total_pages' => ceil($total_items / $per_page) // calculate pages count
            ));
    }

}