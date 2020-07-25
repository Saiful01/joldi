package com.joldi.ui;

import android.Manifest;
import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.widget.Toast;

import com.google.zxing.Result;
import com.joldi.model.ResponseModel;
import com.joldi.parcel.R;
import com.joldi.server.ServerApi;
import com.joldi.utils.CommonUtils;
import com.joldi.utils.SharedPrefClass;

import androidx.annotation.NonNull;
import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;
import me.dm7.barcodescanner.zxing.ZXingScannerView;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class CollectParcelActivity extends AppCompatActivity implements ZXingScannerView.ResultHandler {
    private ZXingScannerView zXingScannerView;
    private static final int MY_CAMERA_REQUEST_CODE = 100;
    ProgressDialog progressDialog;
    SharedPrefClass sharedPrefObj;

    double total_collectable = 0;
    int total_parcel = 0;

    @RequiresApi(api = Build.VERSION_CODES.M)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_collect_parcel);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        if (checkSelfPermission(Manifest.permission.CAMERA) != PackageManager.PERMISSION_GRANTED) {
            requestPermissions(new String[]{Manifest.permission.CAMERA}, MY_CAMERA_REQUEST_CODE);
        } else {
            openCamera();
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (requestCode == MY_CAMERA_REQUEST_CODE) {
            if (grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                Toast.makeText(this, "camera permission granted", Toast.LENGTH_LONG).show();
                openCamera();
            } else {
                Toast.makeText(this, "camera permission denied", Toast.LENGTH_LONG).show();
                startActivity(new Intent(getApplicationContext(), HomeActivity.class));
            }
        }
    }


    private void openCamera() {

        zXingScannerView = new ZXingScannerView(getApplicationContext());
        setContentView(zXingScannerView);
        zXingScannerView.setResultHandler(this);
        zXingScannerView.startCamera();
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {

        if (item.getItemId() == android.R.id.home) {
            finish();
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

  /*  @Override
    protected void onPause() {
        super.onPause();
        zXingScannerView.stopCamera();
    }*/

    @Override
    public void handleResult(Result result) {
        //Toast.makeText(getApplicationContext(), result.getText(), Toast.LENGTH_SHORT).show();
        gettingResponseFromServer(String.valueOf(result));
    }

    private void collectingStatus(double amount) {

        total_parcel++;
        total_collectable = total_collectable + amount;


        AlertDialog alertDialog = new AlertDialog.Builder(CollectParcelActivity.this).create();
        alertDialog.setTitle(R.string.collect_parcel);

        alertDialog.setMessage(getString(R.string.total_amount) + " " + total_collectable + getString(R.string.total_parcel) + " " + total_parcel);
        alertDialog.setButton(AlertDialog.BUTTON_NEUTRAL, getString(R.string.collect_more),
            new DialogInterface.OnClickListener() {
                public void onClick(DialogInterface dialog, int which) {
                    Log.d("MOTIUR", "Yes");
                    dialog.dismiss();
                    cameraPreview();
                }
            });

        alertDialog.setButton(AlertDialog.BUTTON_NEGATIVE, getString(R.string.go_home),
            new DialogInterface.OnClickListener() {
                public void onClick(DialogInterface dialog, int which) {

                    Log.d("MOTIUR", "NO");
                    dialog.dismiss();
                    zXingScannerView.stopCamera();
                    startActivity(new Intent(getApplicationContext(), HomeActivity.class));
                    finish();
                }
            });
        alertDialog.show();
    }

    private void gettingResponseFromServer(String invoice_number) {

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

                        CommonUtils.message(getApplicationContext(), "Successfully Updated");
                        Log.d("MOTIUR", response.body().getTotalAmount() + "");
                        collectingStatus(response.body().getTotalAmount());
                    }
                }
            }

            @Override
            public void onFailure(Call<ResponseModel> call, Throwable t) {
                CommonUtils.message(getApplicationContext(), "There is an error" + t.getMessage());
            }
        });

    }

    public void cameraPreview() {
        zXingScannerView.resumeCameraPreview(this);
    }
}
