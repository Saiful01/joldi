package com.joldi.ui.send;

import android.app.ProgressDialog;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.joldi.adapter.ParcelAdapter;
import com.joldi.model.parcel.ParcelData;
import com.joldi.parcel.R;

import java.util.ArrayList;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.Observer;
import androidx.lifecycle.ViewModelProviders;
import androidx.recyclerview.widget.RecyclerView;

public class SendFragment extends Fragment {

    ProgressDialog progressDoalog;
    private com.joldi.parcel.ui.send.SendViewModel sendViewModel;

    RecyclerView rvListDemo;
    private ArrayList<ParcelData> mNameList;
    private ParcelAdapter mAdapter;


    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {
        sendViewModel =
                ViewModelProviders.of(this).get(com.joldi.parcel.ui.send.SendViewModel.class);
        View root = inflater.inflate(R.layout.fragment_send, container, false);


        progressDoalog = new ProgressDialog(getContext());
        progressDoalog.setMessage("Loading....");
        progressDoalog.show();

        //gettingData();


        final TextView textView = root.findViewById(R.id.text_send);
        sendViewModel.getText().observe(this, new Observer<String>() {
            @Override
            public void onChanged(@Nullable String s) {
                textView.setText(s);
            }
        });
        return root;
    }

/*    private void gettingData() {

        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl(ServerApi.BASE_URL)
                .addConverterFactory(GsonConverterFactory.create()) //Here we are using the GsonConverterFactory to directly convert json data to object
                .build();

        ServerApi api = retrofit.create(ServerApi.class);

        Call<Parcel> call = api.getParcelList("project1", "1234", "396");

        call.enqueue(new Callback<Parcel>() {
            @Override
            public void onResponse(Call<Parcel> call, Response<Parcel> response) {

                Log.d("Motiur", "Getting Datas" + response.body().getStatusCode());

                progressDoalog.dismiss();
                if (response.body() != null) {
                    if (response.isSuccessful()) {
                        Toast.makeText(getContext(), "OK", Toast.LENGTH_SHORT).show();
                    }
                }

            }

            @Override
            public void onFailure(Call<Parcel> call, Throwable t) {
                Log.d("Motiur", "Getting Datta");
                Toast.makeText(getContext(), "No", Toast.LENGTH_SHORT).show();

                progressDoalog.dismiss();
            }
        });
    }*/

}