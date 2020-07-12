package com.joldi.ui;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.Toast;

import com.joldi.adapter.TrackingAdapter;
import com.joldi.model.orderTrack.OrderData;
import com.joldi.model.orderTrack.Orders;
import com.joldi.parcel.R;
import com.joldi.server.ServerApi;
import com.joldi.utils.CommonUtils;

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

public class OrderTrackingActivity extends AppCompatActivity {

    EditText etPhone;
    ProgressDialog progressDoalog;
    RecyclerView rclList;
    private ArrayList<OrderData> trackingList;
    private TrackingAdapter tAdapter;
    LinearLayout lnVisble;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_order_tracking);

        etPhone = findViewById(R.id.etPhone);
        rclList = findViewById(R.id.parcelList);
        lnVisble = findViewById(R.id.empty);

        setTitle(getString(R.string.order_tracking));
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        if (item.getItemId() == android.R.id.home) {
            finish();
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    public void trackOrder(View view) {
        String phone = etPhone.getText().toString();

        if (etPhone == null || etPhone.length() < 11) {
            CommonUtils.message(getApplicationContext(), getString(R.string.valid_phone_err));
        } else {
            gettingData(phone);
        }

    }


    private void gettingData(String phone) {

        progressDoalog = new ProgressDialog(OrderTrackingActivity.this);
        progressDoalog.setMessage(getResources().getString(R.string.loading));
        progressDoalog.setCancelable(false);
        progressDoalog.show();

        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl(ServerApi.BASE_URL)
                .addConverterFactory(GsonConverterFactory.create())
                .build();

        ServerApi api = retrofit.create(ServerApi.class);
        Call<Orders> call = api.getParcelByPhoneNumber(phone, CommonUtils.getToken(), "all");

        call.enqueue(new Callback<Orders>() {
            @Override
            public void onResponse(Call<Orders> call, Response<Orders> response) {

                progressDoalog.dismiss();
                trackingList = new ArrayList<OrderData>();

                for (int i = 0; i < response.body().getData().size(); i++) {


                    trackingList.add(new OrderData(
                            response.body().getData().get(i).getParcelId(),
                            response.body().getData().get(i).getParcelInvoice(),
                            response.body().getData().get(i).getDeliveryDate(),
                            response.body().getData().get(i).getDeliveryStatus(),
                            response.body().getData().get(i).getCustomerName(),
                            response.body().getData().get(i).getCustomerPhone(),
                            response.body().getData().get(i).getCustomerAddress()
                    ));
                }

                if (response.body().getData().size() <= 0) {

                    lnVisble.setVisibility(View.VISIBLE);

                    //CommonUtils.message(getApplicationContext(), "No Parcels");
                }

                RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(getApplicationContext());
                tAdapter = new TrackingAdapter(getApplicationContext(), trackingList);
                rclList.setLayoutManager(mLayoutManager);
                rclList.setItemAnimator(new DefaultItemAnimator());
                rclList.setAdapter(tAdapter);


                if (response.body() != null) {
                    if (response.isSuccessful()) {
                        //Toast.makeText(getApplicationContext(), "OK", Toast.LENGTH_SHORT).show();
                    }
                }
            }

            @Override
            public void onFailure(Call<Orders> call, Throwable t) {
                Log.d("Motiur", "Getting Data");
                Toast.makeText(getApplicationContext(), "There is an error", Toast.LENGTH_SHORT).show();

                progressDoalog.dismiss();
            }
        });
    }


}
