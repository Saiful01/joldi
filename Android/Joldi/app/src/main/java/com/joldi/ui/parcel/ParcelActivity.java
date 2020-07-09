package com.joldi.ui.parcel;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.joldi.adapter.ParcelAdapter;
import com.joldi.model.parcel.Parcel;
import com.joldi.model.parcel.ParcelData;
import com.joldi.parcel.R;
import com.joldi.server.ServerApi;
import com.joldi.utils.CommonUtils;
import com.joldi.utils.SharedPrefClass;

import java.util.ArrayList;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.DefaultItemAnimator;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class ParcelActivity extends AppCompatActivity {

    ProgressDialog progressDoalog;

    RecyclerView parcelListView;
    private ArrayList<ParcelData> parcelList;
    private ParcelAdapter mAdapter;
    TextView tvEmpty;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_parcel);

        parcelListView = findViewById(R.id.parcelListView);
        tvEmpty = findViewById(R.id.empty);
        Intent intent = getIntent();
        gettingData(intent.getStringExtra("status"));

        setTitle(intent.getStringExtra("title"));
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);


    }


    private void gettingData(String status) {

        Log.d("Motiur", "Getting Data"+SharedPrefClass.getValueId(getApplicationContext()));
        progressDoalog = new ProgressDialog(ParcelActivity.this);
        progressDoalog.setMessage(getString(R.string.loading));
        progressDoalog.setCancelable(false);
        progressDoalog.show();

        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl(ServerApi.BASE_URL)
                .addConverterFactory(GsonConverterFactory.create()) //Here we are using the GsonConverterFactory to directly convert json data to object
                .build();

        ServerApi api = retrofit.create(ServerApi.class);

        Call<Parcel> call = api.getParcelList(SharedPrefClass.getValueId(getApplicationContext()), CommonUtils.getToken(), status);

        call.enqueue(new Callback<Parcel>() {
            @Override
            public void onResponse(Call<Parcel> call, Response<Parcel> response) {


                progressDoalog.dismiss();

                parcelList = new ArrayList<ParcelData>();

                for (int i = 0; i < response.body().getData().size(); i++) {
                    Log.i("data", "onResponse: " + response.body().getData().get(i).getCustomerAddress());

                    parcelList.add(new ParcelData(
                            response.body().getData().get(i).getParcelId(),
                            response.body().getData().get(i).getParcelInvoice(),
                            response.body().getData().get(i).getDeliveryDate(),
                            response.body().getData().get(i).getDeliveryStatus(),
                            response.body().getData().get(i).getCustomerName(),
                            response.body().getData().get(i).getCustomerPhone(),
                            response.body().getData().get(i).getCustomerAddress()
                    ));

                    //Log.d("Motiur", "Getting Datas" + response.body().getData().get(i).getCustomerName());
                }

                if (response.body().getData().size() <= 0) {

                    tvEmpty.setText(R.string.no_parcel);
                    tvEmpty.setVisibility(View.VISIBLE);

                    //CommonUtils.message(getApplicationContext(), "No Parcels");
                }


                RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(getApplicationContext());
                mAdapter = new ParcelAdapter(getApplicationContext(), parcelList);
                parcelListView.setLayoutManager(mLayoutManager);
                parcelListView.setItemAnimator(new DefaultItemAnimator());
                parcelListView.setAdapter(mAdapter);


            }

            @Override
            public void onFailure(Call<Parcel> call, Throwable t) {
                //Log.d("Motiur", "Getting Datta");
                Toast.makeText(ParcelActivity.this, R.string.error, Toast.LENGTH_SHORT).show();

                progressDoalog.dismiss();
            }
        });
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
