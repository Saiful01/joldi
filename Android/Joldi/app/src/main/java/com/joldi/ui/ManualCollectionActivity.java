package com.joldi.ui;

import android.annotation.SuppressLint;
import android.app.ProgressDialog;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;

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

public class ManualCollectionActivity extends AppCompatActivity {

    EditText etInvoice;
    ProgressDialog progressDoalog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_manual_collection);
        etInvoice = findViewById(R.id.etInvoice);


    }

    private void gettingResponseFromServer(String invoice_number) {


        progressDoalog = new ProgressDialog(ManualCollectionActivity.this);
        progressDoalog.setMessage(getResources().getString(R.string.loading));
        progressDoalog.setCancelable(false);
        progressDoalog.show();
        String deliveryManId = String.valueOf(SharedPrefClass.getDeliverymanId(getApplicationContext()));

        Retrofit retrofit = new Retrofit.Builder()
            .baseUrl(ServerApi.BASE_URL)
            .addConverterFactory(GsonConverterFactory.create()) //Here we are using the GsonConverterFactory to directly convert json data to object
            .build();

        ServerApi api = retrofit.create(ServerApi.class);

        Call<ResponseModel> call = api.parcelCollect(invoice_number, CommonUtils.getToken(), deliveryManId, CommonUtils.getAccepted(), "Notes");

        call.enqueue(new Callback<ResponseModel>() {
            @SuppressLint("ResourceAsColor")
            @Override
            public void onResponse(Call<ResponseModel> call, Response<ResponseModel> response) {


                if (response.body() != null) {
                    if (response.isSuccessful()) {
                        progressDoalog.dismiss();
                        CommonUtils.message(getApplicationContext(), "Successfully Updated");
                        finish();
                        Log.d("MOTIUR", response.body().getTotalAmount() + "");

                    }
                }
            }

            @Override
            public void onFailure(Call<ResponseModel> call, Throwable t) {
                progressDoalog.dismiss();
                CommonUtils.message(getApplicationContext(), "There is an error" + t.getMessage());
            }
        });

    }

    public void manualCollectFromMerchant(View view) {

        String invoice_number = etInvoice.getText().toString();
        gettingResponseFromServer(invoice_number);
    }
}
