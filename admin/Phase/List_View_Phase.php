<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 13/09/2015
 * Time: 21:44
 */

require_once(ABSPATH . 'wp-admin/includes/template.php' );

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class List_View_Phase extends WP_List_Table{

    function __construct() {
        parent::__construct( array(
                'singular'=> 'Phase',
                'plural' => 'Phases',
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

    /**
     * [OPTIONAL] this is example, how to render column with actions,
     * when you hover row "Edit | Delete" links showed
     *
     * @param $item - row (key, value array)
     * @return HTML
     */
    function column_valeur($item)
    {

        return sprintf('%s',
            ''.$item['valeur'].''
        );
    }

    function column_active($item){
        $menu_page_ticket_edit = menu_page_url(PREFIX_PLUGINS_NAME."_phase", false );

        if($item['active'] == true){
            $valeur = sprintf('<a href="' .$menu_page_ticket_edit. '&action_active=%s">%s</a>',$item["id"], 'Desactiver');
        }else{
            $valeur = sprintf('<a href="' .$menu_page_ticket_edit. '&action_active=%s">%s</a>',$item["id"], 'Activer');
        }

        return $valeur;
    }

    function column_etape($item){

        return $item['etape'];
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'valeur' => array('valeur', true),
            'active' => array('active', false),
            'etape' => array('etape', true)
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
            'valeur' => 'Libelle',
            'active' => 'Action',
            'etape' => 'Etape'
        );
        return $columns;
    }


    function prepare_items($search = NULL) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'miss_phase';

        $per_page = 25;

        $columns = self::get_columns();
        $hidden = array();
        $sortable = self::get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);




        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys(self::get_sortable_columns()))) ? $_REQUEST['orderby'] : 'etape';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';

        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array
        if(!empty($search)){
            $search = trim($search);
            // will be used in pagination settings
            $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name WHERE valeur LIKE '%".$search."%'");
            $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE valeur LIKE '%%%s%%' ORDER BY $orderby $order LIMIT %d OFFSET %d", $search, $per_page, ($paged*$per_page)), ARRAY_A);

        }else{
            // will be used in pagination settings
            $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name ");
            $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, ($paged*$per_page)), ARRAY_A);

        }

        // [REQUIRED] configure pagination
        self::set_pagination_args(array(
                'total_items' => $total_items, // total items defined above
                'per_page' => $per_page, // per page constant defined at top of method
                'total_pages' => ceil($total_items / $per_page) // calculate pages count
            ));
    }

}