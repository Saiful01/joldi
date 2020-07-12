package com.joldi.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.widget.Toast;

import java.net.InetAddress;

public class CommonUtils {


    public static boolean isNetworkConnected(Context context) {
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);

        if (cm.getActiveNetworkInfo() != null && cm.getActiveNetworkInfo().isConnected()) {
           /* try {
                InetAddress ipAddr = InetAddress.getByName("google.com");
                //You can replace it with your name
                //return !ipAddr.equals("");
                return true;


            } catch (Exception e) {
                return false;
            }*/
            return true;

        } else {
            return false;
        }
    }


    public static boolean isInternetAvailable() {
        try {
            InetAddress ipAddr = InetAddress.getByName("google.com");
            //You can replace it with your name
            return !ipAddr.equals("");

        } catch (Exception e) {
            return false;
        }
    }

    public static void message(Context context, String message) {

        Toast.makeText(context, message, Toast.LENGTH_SHORT).show();

    }

    public static String getToken() {

        return "ABCD";
    }

    public static String getDelivered() {

        return "delivered";
    }

    public static String getReturendParcel() {

        return "returned";
    }

    public static String getOtheWay() {

        return "on_the_way";
    }

    public static String getAccepted() {

        return "accepted";
    }

    public static String getAll() {

        return "all";
    }

    public static String getPending() {

        return "pending";
    }

    public static String getPickUpAssigned() {

        return "pickup_man_assigned";
    }

    public static String getCancelled() {

        return "cancelled";
    }

    public static String getOnTheWay() {

        return "on_the_way";
    }

    public static String getDeliverymanassigned() {

        return "delivery_man_assigned";
    }

    public static String getPartialDeliveryStatus() {

        return "partial_delivered";
    }

}
