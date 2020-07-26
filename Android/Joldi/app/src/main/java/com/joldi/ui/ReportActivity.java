package com.joldi.ui;

import android.annotation.SuppressLint;
import android.app.ProgressDialog;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;

import com.joldi.model.Report;
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

public class ReportActivity extends AppCompatActivity {

    TextView tvDeliver, tvCancelled, tvOngoing;
    ProgressDialog progressDoalog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_report);

        tvDeliver = findViewById(R.id.deliver_count);
        tvCancelled = findViewById(R.id.cancelled_count);
        tvOngoing = findViewById(R.id.ongoing_count);

        gettingData("today");

        setTitle("Report");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);
    }

    public void today(View view) {

        gettingData("today");
    }

    public void week(View view) {
        gettingData("week");
    }

    public void month(View view) {
        gettingData("month");
    }

    public void lifetime(View view) {
        gettingData("lifetime");
    }


    public void gettingData(String range) {

        progressDoalog = new ProgressDialog(ReportActivity.this);
        progressDoalog.setMessage(getResources().getString(R.string.loading));
        progressDoalog.show();

        Retrofit retrofit = new Retrofit.Builder()
            .baseUrl(ServerApi.BASE_URL)
            .addConverterFactory(GsonConverterFactory.create()) //Here we are using the GsonConverterFactory to directly convert json data to object
            .build();

        ServerApi api = retrofit.create(ServerApi.class);

        Call<Report> call = api.gettingReport(SharedPrefClass.getDeliverymanId(getApplicationContext()) + "", CommonUtils.getToken(), range);

        call.enqueue(new Callback<Report>() {
            @SuppressLint("ResourceAsColor")
            @Override
            public void onResponse(Call<Report> call, Response<Report> response) {


                if (response.body() != null) {
                    if (response.isSuccessful()) {
                        //CommonUtils.message(getApplicationContext(), "Successfully Updated");
                        if (response.body().getStatusCode() == 200) {
                            UpdateUi(response.body().getDeliveredParcels(), response.body().getOngoingParcels(), response.body().getCancelledParcels());
                        }


                    }
                } else {
                    Log.d("MOTIUR", response.body() + "");
                }

                progressDoalog.dismiss();
            }

            @Override
            public void onFailure(Call<Report> call, Throwable t) {
                progressDoalog.dismiss();
                CommonUtils.message(getApplicationContext(), "There is an error" + t.getMessage());
            }
        });
    }

    private void UpdateUi(int delivered, int ongoing, int cancelled) {

        tvCancelled.setText(cancelled + "");
        tvDeliver.setText(delivered + "");
        tvOngoing.setText(ongoing + "");
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
