package com.joldi.ui.pdetails;

import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.joldi.adapter.PDetailsStatusAdapter;
import com.joldi.model.ResponseModel;
import com.joldi.model.pDetails.DParcel;
import com.joldi.model.pDetails.DParcelData;
import com.joldi.model.pDetails.DStatus;
import com.joldi.parcel.R;
import com.joldi.server.ServerApi;
import com.joldi.ui.PartialDeliverActivity;
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

public class ParcelDetailsActivity extends AppCompatActivity {


    ProgressDialog progressDoalog;
    RecyclerView status_list;
    private ArrayList<DStatus> parcelDetailsList;
    private PDetailsStatusAdapter pAdapter;
    TextView tvInvoice, tvOrderAmount, tvDeliveryCharge, tvTotal, tvDeliveryToName, tvDeliveryToAddress, tvStatus;
    Button btnDeliver, btnReturn, btnMap, btnPartialDeliver;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_parcel_details);

        status_list = findViewById(R.id.status_list);

        tvInvoice = findViewById(R.id.invoice);
        tvOrderAmount = findViewById(R.id.order_amount);
        tvDeliveryCharge = findViewById(R.id.delivery_charge);
        tvTotal = findViewById(R.id.total);
        tvDeliveryToName = findViewById(R.id.name);
        tvDeliveryToAddress = findViewById(R.id.address);
        tvStatus = findViewById(R.id.status);


        btnDeliver = findViewById(R.id.deliverProduct);
        btnReturn = findViewById(R.id.returnProduct);
        btnMap = findViewById(R.id.map);
        btnPartialDeliver = findViewById(R.id.partialDeliver);

        Intent intent = getIntent();
        String parcel_id = intent.getStringExtra("PARCEL_ID");

        setTitle("Parcel Details");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        //Log.d("MOTIUR", parcel_id + "---");
        if (CommonUtils.isNetworkConnected(getApplicationContext())) {
            gettingData(parcel_id);
        } else {
            CommonUtils.message(getApplicationContext(), getString(R.string.no_internet));
        }

    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        if (item.getItemId() == android.R.id.home) {
            finish();
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    private void gettingData(String parcel_id) {

        progressDoalog = new ProgressDialog(ParcelDetailsActivity.this);
        progressDoalog.setMessage(getResources().getString(R.string.loading));
        progressDoalog.show();

        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl(ServerApi.BASE_URL)
                .addConverterFactory(GsonConverterFactory.create())
                .build();

        ServerApi api = retrofit.create(ServerApi.class);
        Call<DParcel> call = api.getParcelDetails(parcel_id, CommonUtils.getToken(), String.valueOf(SharedPrefClass.getDeliverymanId(getApplicationContext())));

        call.enqueue(new Callback<DParcel>() {
            @Override
            public void onResponse(Call<DParcel> call, Response<DParcel> response) {

                progressDoalog.dismiss();
                parcelDetailsList = new ArrayList<DStatus>();


                for (int i = 0; i < response.body().getStatuses().size(); i++) {
                    Log.i("MOTIUR", "onResponse: " + response.body().getStatuses().get(i).getMessage());

                    parcelDetailsList.add(new DStatus(response.body().getStatuses().get(i).getParcelInvoice(), response.body().getStatuses().get(i).getCreatedAt(), response.body().getStatuses().get(i).getMessage(), response.body().getStatuses().get(i).getParcelStatus()));
                }


                Log.i("MOTIUR", "onResponse: " + response.body().getStatuses().size());
                Log.i("MOTIUR", "onResponse: " + response.body().getData());
                Log.i("MOTIUR", "onResponse: " + response.body().getData().getParcelId());

                setValue(response.body().getData());


                RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(getApplicationContext());
                pAdapter = new PDetailsStatusAdapter(getApplicationContext(), parcelDetailsList);
                status_list.setLayoutManager(mLayoutManager);
                status_list.setItemAnimator(new DefaultItemAnimator());
                status_list.setAdapter(pAdapter);

                if (response.body() != null) {
                    if (response.isSuccessful()) {
                        //Toast.makeText(getApplicationContext(), "OK", Toast.LENGTH_SHORT).show();
                    }
                }
            }

            @Override
            public void onFailure(Call<DParcel> call, Throwable t) {
                Log.d("Motiur", "Getting Data");
                Toast.makeText(getApplicationContext(), "There is an error", Toast.LENGTH_SHORT).show();

                progressDoalog.dismiss();
            }
        });
    }

    private void setValue(final DParcelData data) {

        tvInvoice.setText(data.getParcelInvoice());
        tvOrderAmount.setText(data.getPayableAmount());
        tvDeliveryCharge.setText(data.getDeliveryCharge());
        tvTotal.setText(data.getTotalAmount());
        tvDeliveryToName.setText(data.getCustomerName());
        tvDeliveryToAddress.setText(data.getCustomerAddress());

        setStatus(data.getDeliveryStatus());


        btnDeliver.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                AlertDialog alertDialog = new AlertDialog.Builder(ParcelDetailsActivity.this).create();
                alertDialog.setTitle(getString(R.string.product_delivery));
                alertDialog.setMessage(getString(R.string.collecting) + data.getPayableAmount() + getString(R.string.and_deliver_product));
                alertDialog.setButton(AlertDialog.BUTTON_NEUTRAL, getString(R.string.yes),
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {

                                parcelUpdate(data.getParcelId(), data.getDeliveryManId(), CommonUtils.getDelivered());

                                dialog.dismiss();
                            }
                        });

                alertDialog.setButton(AlertDialog.BUTTON_NEGATIVE, getString(R.string.no),
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {

                                dialog.dismiss();
                            }
                        });
                alertDialog.show();

            }
        });

        btnReturn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                Intent intent = new Intent(getApplicationContext(), PartialDeliverActivity.class);
                intent.putExtra("PARCEL_ID", data.getParcelId());
                intent.putExtra("DELIVERYMAN_ID", data.getDeliveryManId());
                startActivity(intent);



                /*
                AlertDialog alertDialog = new AlertDialog.Builder(ParcelDetailsActivity.this).create();
                alertDialog.setTitle(getString(R.string.product_delivery));
                alertDialog.setMessage(getString(R.string.returning_product));
                alertDialog.setButton(AlertDialog.BUTTON_NEUTRAL, getString(R.string.yes),
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {

                                parcelUpdate(data.getParcelId(), data.getDeliveryManId(), CommonUtils.getReturendParcel());

                                dialog.dismiss();
                            }
                        });

                alertDialog.setButton(AlertDialog.BUTTON_NEGATIVE, getString(R.string.no),
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {

                                dialog.dismiss();
                            }
                        });
                alertDialog.show();*/

            }
        });

        btnMap.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                try {
                    String map = "http://maps.google.co.in/maps?q=" + data.getCustomerAddress();
                    Intent i = new Intent(Intent.ACTION_VIEW, Uri.parse(map));
                    startActivity(i);
                } catch (Exception ex) {
                    Log.d("MOTIUR", "ERR" + ex.getMessage());
                }
            }
        });

        btnPartialDeliver.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getApplicationContext(), PartialDeliverActivity.class);
                intent.putExtra("PARCEL_ID", data.getParcelId());
                intent.putExtra("DELIVERYMAN_ID", data.getDeliveryManId());
                startActivity(intent);
            }
        });

    }

    private void parcelUpdate(String parcelId, String deliveryManId, final String status) {

        //.d("MOTIUR", parcelId + "--" + CommonUtils.getToken() + "--" + deliveryManId + "--" + status + "--" + "Notes");
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl(ServerApi.BASE_URL)
                .addConverterFactory(GsonConverterFactory.create()) //Here we are using the GsonConverterFactory to directly convert json data to object
                .build();

        ServerApi api = retrofit.create(ServerApi.class);

        Call<ResponseModel> call = api.updateParcel(parcelId, CommonUtils.getToken(), deliveryManId, status, "Notes");

        call.enqueue(new Callback<ResponseModel>() {
            @SuppressLint("ResourceAsColor")
            @Override
            public void onResponse(Call<ResponseModel> call, Response<ResponseModel> response) {


                if (response.body() != null) {
                    if (response.isSuccessful()) {

                        CommonUtils.message(getApplicationContext(), "Successfully Updated");
                        setStatus(status);


                    }
                }
            }

            @Override
            public void onFailure(Call<ResponseModel> call, Throwable t) {

                CommonUtils.message(getApplicationContext(), "There is an error" + t.getMessage());
            }
        });
    }

    @SuppressLint("ResourceAsColor")
    private void setStatus(String status) {

        Log.d("MOTIUR", status+"kkkkk");

        if (status.equals(CommonUtils.getDelivered()) || (status.equals(CommonUtils.getPartialDeliveryStatus()) || (status.equals(CommonUtils.getPickUpAssigned()) || (status.equals(CommonUtils.getReturendParcel()))))) {
            btnReturn.setEnabled(false);
            btnDeliver.setEnabled(false);
            btnPartialDeliver.setEnabled(false);
            btnDeliver.setBackgroundResource(R.drawable.bg_disable);
            btnReturn.setBackgroundResource(R.drawable.bg_disable);
            btnPartialDeliver.setBackgroundResource(R.drawable.bg_disable);
        }



        tvStatus.setText(status);
        if (status.equals(CommonUtils.getDelivered())) {
            tvStatus.setTextColor(R.color.colorPrimary);
        } else if (status.equals(CommonUtils.getPending())) {
            tvStatus.setTextColor(R.color.yellow);
        } else if (status.equals(CommonUtils.getAccepted())) {
            tvStatus.setTextColor(R.color.colorPrimaryDark);
        } else if (status.equals(CommonUtils.getReturendParcel())) {
            tvStatus.setTextColor(R.color.colorAccent);
        } else {
            tvStatus.setTextColor(R.color.red);
        }
    }

}
