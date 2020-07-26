package com.joldi.ui;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.joldi.model.login.Login;
import com.joldi.parcel.R;
import com.joldi.server.ServerApi;
import com.joldi.utils.CommonUtils;

import androidx.appcompat.app.AppCompatActivity;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class ForgetPasswordActivity extends AppCompatActivity {

    EditText etEmail;
    ProgressDialog progressDoalog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_forget_password);

        etEmail = findViewById(R.id.etEmail);


    }

    public void resetPassword(View view) {

        String email = etEmail.getText().toString();
        if (email == null) {
            CommonUtils.message(getApplicationContext(), "Enter a valid email");
        }

        progressDoalog = new ProgressDialog(ForgetPasswordActivity.this);
        progressDoalog.setMessage(getResources().getString(R.string.loading));
        progressDoalog.show();

        final Retrofit retrofit = new Retrofit.Builder()
            .baseUrl(ServerApi.BASE_URL)
            .addConverterFactory(GsonConverterFactory.create())
            .build();

        ServerApi api = retrofit.create(ServerApi.class);
        Call<Login> call = api.resetPassword(email, CommonUtils.getToken());

        call.enqueue(new Callback<Login>() {
            @Override
            public void onResponse(Call<Login> call, Response<Login> response) {

                Log.d("MOTIUR", response.message() + "--" + response.body().getStatusCode() + "");
                progressDoalog.dismiss();
                if (response.body() != null) {
                    if (response.body().getStatusCode() == 200) {

                        CommonUtils.message(getApplicationContext(), "Please check your email");

                        Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
                        startActivity(intent);
                        finish();

                    } else {
                        CommonUtils.message(getApplicationContext(), getString(R.string.email_or_pass_wrong));
                    }
                }
            }

            @Override
            public void onFailure(Call<Login> call, Throwable t) {
                progressDoalog.dismiss();
                Toast.makeText(getApplicationContext(), "There is an Error", Toast.LENGTH_LONG).show();

            }
        });


    }
}
