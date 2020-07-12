package com.joldi.ui;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.res.Configuration;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Toast;

import com.joldi.parcel.R;
import com.joldi.utils.SharedPrefClass;

import java.util.Locale;

import androidx.appcompat.app.AppCompatActivity;

public class StartActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_start);
        setTitle(getString(R.string.joldi_parcel));
    }

    public void user(View view) {

        Intent intent = new Intent(getApplicationContext(), OrderTrackingActivity.class);
        startActivity(intent);
        //finish();

    }

    public void rider(View view) {
        Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
        startActivity(intent);

    }

    public void changeLanguage(View view) {

        //CommonUtils.message(getApplicationContext(), "hello");
        showRadioButtonDialog();

    }

    private void showRadioButtonDialog() {

        // custom dialog

        AlertDialog.Builder alertDialog = new AlertDialog.Builder(StartActivity.this);
        alertDialog.setTitle(R.string.change_language);
        String[] items = {"বাংলা", "English"};
        int checkedItem = 1;
        if (SharedPrefClass.getLanguageStatus(getApplicationContext()).equals("bn")) {
            checkedItem = 0;
        }

        alertDialog.setSingleChoiceItems(items, checkedItem, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                switch (which) {
                    case 0:
                        Toast.makeText(StartActivity.this, R.string.set_bangla, Toast.LENGTH_LONG).show();
                        SharedPrefClass.saveLanguageStatus(getApplicationContext(), "bn");
                        setLanguage();

                        dialog.dismiss();
                        break;
                    case 1:
                        Toast.makeText(StartActivity.this, R.string.set_english, Toast.LENGTH_LONG).show();
                        SharedPrefClass.saveLanguageStatus(getApplicationContext(), "en");
                        setLanguage();
                        dialog.dismiss();
                        break;
                }
            }
        });
        AlertDialog alert = alertDialog.create();
        alert.setCanceledOnTouchOutside(false);
        alert.show();
    }

    private void setLanguage() {
        Log.d("MOTIUR", SharedPrefClass.getLanguageStatus(getApplicationContext()));

        String languageToLoad = SharedPrefClass.getLanguageStatus(getApplicationContext());
        Locale locale = new Locale(languageToLoad);
        Configuration config = new Configuration();
        config.locale = locale;
        getResources().updateConfiguration(config, getResources().getDisplayMetrics());
        restartActivity();

    }

    private void restartActivity() {
        Intent intent = getIntent();
        finish();
        startActivity(intent);
    }

}
