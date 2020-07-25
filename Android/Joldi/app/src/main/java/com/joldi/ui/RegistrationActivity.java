package com.joldi.ui;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.Spinner;
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

public class RegistrationActivity extends AppCompatActivity {

    EditText eEmail, eUsername, ePassword, ePhone, eAddress;
    ProgressDialog progressDoalog;
    private Spinner spinner;
    private static final String[] paths = {"Motorbike", "Cycle"};

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_registration);

        eEmail = findViewById(R.id.etEmail);
        eUsername = findViewById(R.id.etUsername);
        ePassword = findViewById(R.id.etPassword);
        ePhone = findViewById(R.id.etPhone);
        eAddress = findViewById(R.id.etAddress);
        spinner = findViewById(R.id.spinner);
        ArrayAdapter<String> adapter = new ArrayAdapter<String>(RegistrationActivity.this,
            android.R.layout.simple_spinner_item, paths);

        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner.setAdapter(adapter);
        //spinner.setOnItemSelectedListener((AdapterView.OnItemSelectedListener) getApplicationContext());


        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

    }

    public void loginPage(View view) {
        Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
        startActivity(intent);
    }

    public void doRegistration(View view) {

        String etEmail = eEmail.getText().toString();
        String etUsername = eUsername.getText().toString();
        String etPassword = ePassword.getText().toString();
        String etPhone = ePhone.getText().toString();
        String etAddress = eAddress.getText().toString();
        String type = spinner.getSelectedItem().toString();

        gettingData(etEmail, etUsername, etPassword, etPhone, etAddress, type);


    }

    private boolean gettingData(String email, String username, String password, String phone, String address, String type) {
        final boolean status = false;

        progressDoalog = new ProgressDialog(RegistrationActivity.this);
        progressDoalog.setMessage(getResources().getString(R.string.loading));
        progressDoalog.show();

        final Retrofit retrofit = new Retrofit.Builder()
            .baseUrl(ServerApi.BASE_URL)
            .addConverterFactory(GsonConverterFactory.create())
            .build();

        ServerApi api = retrofit.create(ServerApi.class);
        Call<Login> call = api.registrationDo(email, username, password, phone, address,type, CommonUtils.getToken());

        call.enqueue(new Callback<Login>() {
            @Override
            public void onResponse(Call<Login> call, Response<Login> response) {

                Log.d("MOTIUR", response.message() + "--" + response.body().getStatusCode() + "");
                progressDoalog.dismiss();
                if (response.body() != null) {
                    if (response.body().getStatusCode() == 200) {

                       /* Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
                        startActivity(intent);*/
                        CommonUtils.message(getApplicationContext(), "Successfully Registered, Admin will activate your account soon");
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

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        if (item.getItemId() == android.R.id.home) {
            finish();
            return true;
        }
        return super.onOptionsItemSelected(item);
    }
}
