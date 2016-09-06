<?php
/**
 * Created by PhpStorm.
 * User: Vercossa
 * Date: 13/09/2015
 * Time: 12:34
 */


class DataTable{

    public function create_datatable_MissOrangina(){
        global $wpdb;
        global $custom_table_example_db_version;
        $custom_table_example_db_version = '1.0';
        $charset_collate = $wpdb->get_charset_collate();

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');

        $table_name = $wpdb->prefix . 'miss_lieu';
        $sql        = "CREATE TABLE $table_name (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  ville int NULL,
			  datelieu VARCHAR(255) NULL ,
			  heure VARCHAR(255) NULL,
			  lieu VARCHAR(255) NULL,
			  etape int NULL,
			  passe int NULL,
			  PRIMARY KEY (id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        dbDelta( $sql );

        $table_name = $wpdb->prefix . 'miss_ville';
        $sql        = "CREATE TABLE $table_name (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  ville varchar(255) NULL,
			  abreviation varchar(4) NULL,
			  PRIMARY KEY (id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        dbDelta( $sql );

        $table_name = $wpdb->prefix . 'miss_vote';
        $sql        = "CREATE TABLE $table_name (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  idcandidat int(11) NULL,
			  idfacebook varchar(255) NULL,
			  etape int(11) NULL,
			  PRIMARY KEY (id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        dbDelta( $sql );

//        $table_name = $wpdb->prefix . 'miss_email';
//        $sql        = "CREATE TABLE $table_name (
//			  id int(11) NOT NULL AUTO_INCREMENT,
//			  email varchar(255) NULL,
//			  PRIMARY KEY (id)
//			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
//
//        dbDelta( $sql );


        $table_name = $wpdb->prefix . 'miss_parrain';
        $sql        = "CREATE TABLE $table_name (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  email varchar(255) NULL,
			  idcandidat int NULL,
			  parrain int(1) NULL,
			  PRIMARY KEY (id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        dbDelta( $sql );

        $table_name = $wpdb->prefix . 'miss_phase';
        $sql        = "CREATE TABLE $table_name (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  valeur varchar(255) NULL,
			  active tinyint(1) NULL,
			  etape int NULL,
			  used int NULL,
			  PRIMARY KEY (id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        dbDelta( $sql );

        $wpdb->insert($wpdb->prefix . 'miss_phase',
            array(
                    'id'     => 1,
                    'valeur' => 'Inscription',
                    'active' => true,
                    'etape' => 0
                ));

        $wpdb->insert($wpdb->prefix . 'miss_phase',
            array(
                'id'     => 2,
                'valeur' => 'Casting',
                'active' => false,
                'etape' => 1
            ));

        $wpdb->insert($wpdb->prefix . 'miss_phase',
            array(
                'id'     => 3,
                'valeur' => 'Quart Final',
                'active' => false,
                'etape' => 2
            ));

        $wpdb->insert($wpdb->prefix . 'miss_phase',
            array(
                'id'     => 4,
                'valeur' => 'Demi Final',
                'active' => false,
                'etape' => 3
            ));

        $wpdb->insert($wpdb->prefix . 'miss_phase',
            array(
                'id'     => 5,
                'valeur' => 'Final',
                'active' => false,
                'etape' => 4
            ));

        $wpdb->insert($wpdb->prefix . 'miss_phase',
            array(
                'id'     => 6,
                'valeur' => 'Gagnant',
                'active' => false,
                'etape' => 5
            ));

        $table_name = $wpdb->prefix . 'miss_inscrit';
        $sql        = "CREATE TABLE $table_name (
			  id int(11) NOT NULL AUTO_INCREMENT,
			  codeins varchar(255) NULL,
			  nom varchar(255) NULL,
			  prenom varchar(255) NULL,
			  dateNais DATE NULL,
			  lieuNais varchar(255) NULL,
			  email varchar(255) NULL,
			  nationalite VARCHAR(255) NULL,
			  adresse TEXT NULL,
			  ville varchar(255) NULL,
			  phone varchar(255) NULL,
			  profession varchar(255) NULL,
			  diplome varchar(255) NULL,
              dream TEXT NULL,
              ambition TEXT NULL,
              loisir VARCHAR(255) NULL,
			  taille varchar(255) NULL,
              qualite varchar(255) NULL,
			  enfant varchar(255) NULL,
			  concours TEXT NULL,
              idfacebook varchar(255) NULL,
              etape int NULL,
              gagnant int NULL,
              inscrit tinyint(1) NULL,
              datecreate datetime NOT NULL ,
              image VARCHAR(255) NULL,
              presentation TEXT NULL,
			  PRIMARY KEY (id)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        dbDelta($sql);

//
//        $table_name = $wpdb->prefix . 'miss_email';
//        $sql        = "CREATE TABLE $table_name (
//			  id int(11) NOT NULL AUTO_INCREMENT,
//			  email varchar(255) NOT NULL
//			  PRIMARY KEY (id)
//			) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
//
//        dbDelta($sql);

        add_option('custom_table_example_db_version', $custom_table_example_db_version);

    }
}