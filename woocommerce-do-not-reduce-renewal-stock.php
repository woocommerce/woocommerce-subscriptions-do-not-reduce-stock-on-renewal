<?php
/*
 * Plugin Name: WooCommerce Subscriptions - Do Not Reduce Stock on Renewal
 * Plugin URI: https://github.com/Prospress/woocommerce-subscriptions-do-not-reduce-stock-on-renewal/
 * Description: By default, WooCommerce reduces stock for any order containing a product. This means stock will be reduced for both the initial purchase of a subscription product and all renewal orders. This extension stops stock being reduced for renewal order payments so that stock is only reduced on the initial purchase. Requires WooCommerce 2.4 or newer and Subscriptiosn 2.0 or newer.
 * Author: Prospress Inc.
 * Author URI: https://prospress.com/
 * License: GPLv3
 *
 * GitHub Plugin URI: Prospress/woocommerce-subscriptions-do-not-reduce-stock-on-renewal
 * GitHub Branch: master
 *
 * Copyright 2017 Prospress, Inc.  (email : freedoms@prospress.com)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package		WooCommerce Subscriptions - Do Not Reduce Stock on Renewal
 * @author		Brent Shepherd
 * @since		1.0
*/

function wcs_do_not_reduce_renewal_stock( $reduce_stock, $order ) {

	if ( function_exists( 'wcs_order_contains_renewal' ) && wcs_order_contains_renewal( $order ) ) { // Subscriptions v2.0+
		$reduce_stock = false;
	} elseif ( class_exists( 'WC_Subscriptions_Renewal_Order' ) && WC_Subscriptions_Renewal_Order::is_renewal( $order ) ) {
		$reduce_stock = false;
	}

	return $reduce_stock;
}
add_filter( 'woocommerce_can_reduce_order_stock', 'wcs_do_not_reduce_renewal_stock', 10, 2 );
