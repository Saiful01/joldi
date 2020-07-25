package com.joldi.ui;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;

import com.joldi.model.ResponseModel;
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

public class ReturnParcelActivity extends AppCompatActivity {
    TextView etNotes;
    String parcel_id, deliveryman_id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_return_parcel);

        etNotes = findViewById(R.id.etNotes);

        Intent intent = getIntent();
        parcel_id = intent.getStringExtra("PARCEL_ID");
        deliveryman_id = intent.getStringExtra("DELIVERYMAN_ID");

        setTitle("Return Details");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        //Toast.makeText(getApplicationContext(), parcel_id + "--" + deliveryman_id + "--" + SharedPrefClass.getValueId(getApplicationContext()), Toast.LENGTH_SHORT).show();
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        if (item.getItemId() == android.R.id.home) {
            finish();
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    public void partialSave(View view) {

        Log.d("MOTIUR", parcel_id);

        String notes = etNotes.getText().toString();

        Retrofit retrofit = new Retrofit.Builder()
            .baseUrl(ServerApi.BASE_URL)
            .addConverterFactory(GsonConverterFactory.create()) //Here we are using the GsonConverterFactory to directly convert json data to object
            .build();

        ServerApi api = retrofit.create(ServerApi.class);

        Call<ResponseModel> call = api.returnParcelDeliver(
            parcel_id,
            CommonUtils.getToken(),
            SharedPrefClass.getValueId(getApplicationContext()) + "",
            CommonUtils.getReturendParcel(),
            notes);

        call.enqueue(new Callback<ResponseModel>() {
            @SuppressLint("ResourceAsColor")
            @Override
            public void onResponse(Call<ResponseModel> call, Response<ResponseModel> response) {


                if (response.body() != null) {
                    if (response.isSuccessful()) {
                        CommonUtils.message(getApplicationContext(), response.body().getMessage());
                        startActivity(new Intent(getApplicationContext(), HomeActivity.class));
                        finish();

                    }
                }
            }

            @Override
            public void onFailure(Call<ResponseModel> call, Throwable t) {

                CommonUtils.message(getApplicationContext(), "There is an error" + t.getMessage());
            }
        });


    }
}
