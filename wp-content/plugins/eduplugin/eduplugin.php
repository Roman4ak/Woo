<?php
/**
* Plugin Name: Eduplugin
* Description: Test.
* Version: 0.1
* Author: Roman
**/

function my_plugin_menu() {
    add_submenu_page(
        'woocommerce',
        'Мої зони доставлення',
        'Мої зони доставлення',
        'manage_options',
        'my-plugin-zones',
        'my_plugin_zones_page'
    );
}
add_action( 'admin_menu', 'my_plugin_menu' );

function my_plugin_activate() {
    global $wpdb;
    $wpdb->query( "ALTER TABLE {$wpdb->prefix}woocommerce_shipping_zones ADD zone_price DECIMAL(10,2) NOT NULL DEFAULT '0.00'" );
}
register_activation_hook( __FILE__, 'my_plugin_activate' );


function my_plugin_zones_page() {
    global $wpdb;
    
    // Отримуємо список зон доставлення з бази даних
    $zones = $wpdb->get_results(
        "SELECT * FROM {$wpdb->prefix}woocommerce_shipping_zones"
    );
    
    // Перевіряємо, чи була відправлена форма
    if ( isset( $_POST['zone_id'] ) ) {
        $zone_id = intval( $_POST['zone_id'] );
        $zone_name = sanitize_text_field( $_POST['zone_name'] );
        $zone_price = floatval( $_POST['zone_price'] ); // додано нове поле
        
        // Оновлюємо назву та ціну зони доставлення в базі даних
        $wpdb->update(
            "{$wpdb->prefix}woocommerce_shipping_zones",
            array( 'zone_name' => $zone_name, 'zone_price' => $zone_price ),
            array( 'zone_id' => $zone_id )
        );
    }
    
    // Виводимо список зон доставлення з можливістю редагування їх назв та цін
    echo '<table class="widefat">';
    echo '<thead><tr><th>ID</th><th>Назва</th><th>Ціна за доставку</th></tr></thead>';
    echo '<tbody>';
    foreach ( $zones as $zone ) {
        echo '<tr>';
        echo '<td>' . $zone->zone_id . '</td>';
        echo '<td>';
        echo '<form method="post">';
        echo '<input type="hidden" name="zone_id" value="' . $zone->zone_id . '">';
        echo '<input type="text" name="zone_name" value="' . esc_attr( $zone->zone_name ) . '">';
        echo '</td>';
        echo '<td>'; 
        echo '<input type="text" name="zone_price" value="' . esc_attr( $zone->zone_price ?? '' ) . '">';
        echo '</td>';
        echo '<td>';
        echo '<input type="submit" class="button" value="Зберегти">';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

    // Код для вставки карти
    echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d102231.82279073424!2d24.005704156766346!3d49.84295799838453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473ae12c78a7e545%3A0xd7b528d0c2cc54f1!2sLviv%2C%20Lviv%20Oblast%2C%20Ukraine!5e0!3m2!1sen!2sus!4v1650271299243!5m2!1sen!2sus" width="100%" height="600" style="border:2px;" allowfullscreen="" loading="lazy"></iframe>';
}


// Видаляємо стандартні поля чекауту
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
    
    // unset($fields['billing']['billing_first_name']);
    // unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    // unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_state']);
    // unset($fields['billing']['billing_postcode']);
    // unset($fields['billing']['billing_phone']);
    // unset($fields['order']['order_comments']);
    // unset($fields['billing']['billing_email']);
    // unset($fields['shipping']['shipping_address_1']);
    // unset($fields['shipping']['shipping_address_2']);
    // unset($fields['shipping']['shipping_city']);
    // unset($fields['shipping']['shipping_state']);
    // unset($fields['shipping']['shipping_postcode']);
    // unset($fields['ship_to_different_address']);

    
    $zones = WC_Shipping_Zones::get_zones();
    $options = array();
    foreach ($zones as $zone) {
        $options[$zone['zone_name']] = $zone['zone_name'];
    }
    $fields['billing']['shipping_zone'] = array(
        'type'     => 'select',
        'class'    => array( 'form-row-wide' ),
        'label'    => __( 'Зони доставки', 'woocommerce' ),
        'required' => true,
        'options'  => array_merge(array('' => __( 'Оберіть зону доставки', 'woocommerce' )), $options),
    );

    $fields['billing']['shipping_options'] = array(
        'type' => 'select',
        'class' => array( 'form-row-wide' ),
        'label' => __( 'Оберіть вулицю', 'woocommerce' ),
        'required' => true,
        'options' => array(
            '' => __( 'Оберіть вулицю', 'woocommerce' ),
        ),
    );

    

    return $fields;
}

add_filter( 'woocommerce_checkout_fields', 'default_checkout_postcode' );

function default_checkout_postcode( $fields ) {
    // Встановлюємо значення "79008" за замовчуванням для поля "postcode"
    $fields['billing']['billing_postcode']['default'] = '79008';
    return $fields;
}

add_action( 'woocommerce_checkout_before_order_review', 'add_checkout_image' );
 
function add_checkout_image() {
    echo '<div class="custom-map">
    <span class="gal"></span>
    <span class="fran"></span>
    <span class="zal"></span>
    <img class="main-map" src="https://st2.depositphotos.com/31006582/45633/v/600/depositphotos_456335086-stock-illustration-urban-city-map-of-lviv.jpg" alt="Checkout Image" />
</div>';
}

