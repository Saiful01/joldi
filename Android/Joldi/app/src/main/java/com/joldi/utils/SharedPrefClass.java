package com.joldi.utils;

import android.content.Context;
import android.content.SharedPreferences;

public class SharedPrefClass {

    public static final String PREF_NAME = "PREF_VALUES";
    public static final String ID = "ID";
    public static final String VALUE_NAME = "VALUE_NAME";
    public static final String VALUE_EMAIL = "VALUE_EMAIL";
    public static final String VALUE_MOBILE = "VALUE_MOBILE";
    public static final boolean VALUE_LOGEDIN = false;

    public static final String VALUE_LANG = "VALUE_LANG";
    private static SharedPreferences sharedPreferences;

    static SharedPreferences.Editor editor;

    public static void saveDeliveryMan(Context context,
                                       String name,
                                       String mobile,
                                       int id) {
        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        editor = sharedPreferences.edit();
        editor.putInt(ID, id);
        editor.putString(VALUE_NAME, name);
        editor.putString(VALUE_MOBILE, mobile);
        editor.apply();

        saveLoginStatus(context, true);
    }


    public static void ClearAll(Context context) {

//        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
//        editor = sharedPreferences.edit();
//        editor.remove(VALUE_LOGEDIN);
//        editor.remove(ID);
//        editor.remove(HUB_ID);
//        editor.remove(VALUE_PREFIX);
//        editor.commit();

        SharedPreferences settings = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        settings.edit().clear().commit();

    }

    public static boolean ClearPreference(Context context) {

        SharedPreferences settings = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        settings.edit().clear().commit();


        return true;
    }

    public static void saveLoginStatus(Context context, boolean isLogged) {

        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        editor = sharedPreferences.edit();
        editor.putBoolean(String.valueOf(VALUE_LOGEDIN), isLogged);
        editor.apply();
    }

    public static boolean getLoginStatus(Context context) {

        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getBoolean(String.valueOf(VALUE_LOGEDIN), false);
    }


    public static void saveLanguageStatus(Context context, String str) {

        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        editor = sharedPreferences.edit();
        editor.putString(VALUE_LANG, str);
        editor.apply();
    }

    public static String getLanguageStatus(Context context) {

        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);

        return sharedPreferences.getString(VALUE_LANG, "bn");

    }


    public static int getValueId(Context context) {
        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getInt(ID, 1);
    }


    public static int getDeliverymanId(Context context) {
        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getInt(ID, 1);
    }


    public static String getName(Context context) {
        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(VALUE_NAME, null);
    }


    public static String getValueEmail(Context context) {
        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(VALUE_EMAIL, null);

    }

    public static String getValueMobile(Context context) {
        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(VALUE_MOBILE, null);
    }

    public static String getValueMerchantId(Context context) {
        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(ID, null);
    }


    public static String getValueAppSecretKey() {

        return "abcd";
    }


    public static void removeValue(Context context) {

        sharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE);
        editor = sharedPreferences.edit();
        editor.remove(VALUE_EMAIL);
        //To clear all values from shared preferences use clear(); method
        //editor.clear();
        editor.apply();
    }


}
