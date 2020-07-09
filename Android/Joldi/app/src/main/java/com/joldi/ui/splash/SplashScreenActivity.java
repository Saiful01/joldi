package com.joldi.ui.splash;

import android.content.Intent;
import android.content.res.Configuration;
import android.os.Bundle;
import android.os.Handler;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.view.animation.LinearInterpolator;
import android.widget.ImageView;

import com.joldi.parcel.R;
import com.joldi.ui.StartActivity;
import com.joldi.utils.SharedPrefClass;

import java.util.Locale;

import androidx.appcompat.app.AppCompatActivity;

public class SplashScreenActivity extends AppCompatActivity {

    private static int SPLASH_TIME_OUT = 3000;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash_screen);

        languageSet();
       /* this.overridePendingTransition(R.anim.left_to_right,
                R.anim.right_to_left);*/

      /*  Animation animation = AnimationUtils.loadAnimation(getApplicationContext(), R.anim.move_right);
        animation.setInterpolator(new LinearInterpolator());
        animation.setRepeatCount(Animation.INFINITE);
        animation.setDuration(1500);

        final ImageView splash = findViewById(R.id.logo);
        splash.startAnimation(animation);*/


        new Handler().postDelayed(new Runnable() {

            @Override
            public void run() {
                Intent i = new Intent(SplashScreenActivity.this, StartActivity.class);//Start Another Activity
                startActivity(i);
                finish();
            }
        }, SPLASH_TIME_OUT);

    }


    public void languageSet() {

        String languageToLoad = SharedPrefClass.getLanguageStatus(getApplicationContext());
        Locale locale = new Locale(languageToLoad);
        Configuration config = new Configuration();
        config.locale = locale;
        getResources().updateConfiguration(config, getResources().getDisplayMetrics());
    }
}
