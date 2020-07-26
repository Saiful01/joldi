package com.joldi.ui;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import com.joldi.model.login.Login;
import com.joldi.parcel.R;
import com.joldi.server.ServerApi;
import com.joldi.utils.CommonUtils;
import com.joldi.utils.SharedPrefClass;

import androidx.appcompat.app.AppCompatActivity;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class LoginActivity extends AppCompatActivity {

    EditText etPhone, etPassword;
    ProgressDialog progressDoalog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        setTitle(getString(R.string.login));

        etPhone = findViewById(R.id.etPhone);
        etPassword = findViewById(R.id.etPassword);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        if (SharedPrefClass.getLoginStatus(getApplicationContext())) {
            startActivity(new Intent(getApplicationContext(), HomeActivity.class));
            finish();
        }


    }

    public void login(View view) {

        String phone = etPhone.getText().toString();
        String password = etPassword.getText().toString();

        if (CommonUtils.isNetworkConnected(getApplicationContext())) {
            gettingData(phone, password);
        } else {
            CommonUtils.message(getApplicationContext(), "Internet is not available");
        }

    }

    @Override
    public void onBackPressed() {
        finish();
        Intent intent = new Intent(LoginActivity.this, StartActivity.class);
        startActivity(intent);
    }


    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        if (item.getItemId() == android.R.id.home) {
            finish();
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    private boolean gettingData(String phone, String password) {
        final boolean status = false;

        progressDoalog = new ProgressDialog(LoginActivity.this);
        progressDoalog.setMessage(getResources().getString(R.string.loading));
        progressDoalog.show();

        final Retrofit retrofit = new Retrofit.Builder()
            .baseUrl(ServerApi.BASE_URL)
            .addConverterFactory(GsonConverterFactory.create())
            .build();

        ServerApi api = retrofit.create(ServerApi.class);
        Call<Login> call = api.loginDo(phone, CommonUtils.getToken(), password);

        call.enqueue(new Callback<Login>() {
            @Override
            public void onResponse(Call<Login> call, Response<Login> response) {

                Log.d("MOTIUR", response.message() + "--" + response.body().getStatusCode() + "");
                progressDoalog.dismiss();
                if (response.body() != null) {
                    if (response.body().getStatusCode() == 200) {


                        SharedPrefClass.saveDeliveryMan(getApplicationContext(),
                            response.body().getLoginData().getDeliveryManName(),
                            response.body().getLoginData().getDeliveryManPhone(),
                            response.body().getLoginData().getDeliveryManId());

                        Log.d("MOTIUR", response.body().getLoginData().getDeliveryManId() + "");

                        Intent intent = new Intent(getApplicationContext(), HomeActivity.class);
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

        return status;
    }

    public void registration(View view) {
        startActivity(new Intent(getApplicationContext(), RegistrationActivity.class));

    }

    public void forgetPassword(View view) {

        startActivity(new Intent(getApplicationContext(), ForgetPasswordActivity.class));
    }

}
