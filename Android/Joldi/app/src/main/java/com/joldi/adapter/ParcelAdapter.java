package com.joldi.adapter;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.joldi.model.parcel.ParcelData;
import com.joldi.parcel.R;
import com.joldi.ui.pdetails.ParcelDetailsActivity;

import java.util.List;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class ParcelAdapter extends RecyclerView.Adapter<ParcelAdapter.ViewHolder> {

    private Context mContext;
    private List<ParcelData> nameList;

    public ParcelAdapter(Context mContext, List<ParcelData> nameList) {
        this.mContext = mContext;
        this.nameList = nameList;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View view = LayoutInflater.from(mContext).inflate(R.layout.parcel_item2, parent, false);
        return new ViewHolder(view);
    }

    @SuppressLint("ResourceAsColor")
    @Override
    public void onBindViewHolder(@NonNull final ViewHolder holder, final int position) {
        holder.tvInvoice.setText(nameList.get(position).getParcelInvoice());
        holder.tvDate.setText(nameList.get(position).getCreatedAt());
        holder.tvDeliveredTo.setText(nameList.get(position).getCustomerName());
        holder.tvPhone.setText(nameList.get(position).getCustomerPhone());
        holder.tvAddress.setText(nameList.get(position).getCustomerAddress());
        holder.tvStatus.setText(nameList.get(position).getDeliveryStatus());

        if (nameList.get(position).getDeliveryStatus().equals("Delivered")) {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_green );
        } else if (nameList.get(position).getDeliveryStatus().equals("pending")) {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_yellow );
        } else if (nameList.get(position).getDeliveryStatus().equals("cancelled")) {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_red);
        } else if (nameList.get(position).getDeliveryStatus().equals("returned")) {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_red );
        } else {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_blue);
        }
        //holder.tvDesignation.setText(nameList.get(position).getDesignation());

        holder.rtlRow.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {


                Intent intent = new Intent(mContext, ParcelDetailsActivity.class);
                intent.putExtra("INVOICE", nameList.get(position).getParcelInvoice());
                intent.putExtra("PARCEL_ID", nameList.get(position).getParcelId());
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_MULTIPLE_TASK);
                mContext.startActivity(intent);

                Toast.makeText(mContext, nameList.get(position).getParcelInvoice(), Toast.LENGTH_SHORT).show();
            }
        });
      /*  holder.tvInvoice.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(mContext, nameList.get(position).getParcelInvoice(), Toast.LENGTH_SHORT).show();
            }
        });*/
    }

    @Override
    public int getItemCount() {
        return nameList.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder {

        TextView tvInvoice, tvDate, tvDeliveredTo, tvPhone, tvAddress, tvStatus;
        RelativeLayout rtlRow;

        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            tvInvoice = itemView.findViewById(R.id.invoice_number);
            tvDate = itemView.findViewById(R.id.date);

            tvDeliveredTo = itemView.findViewById(R.id.delivered_to);
            tvPhone = itemView.findViewById(R.id.phone);
            tvAddress = itemView.findViewById(R.id.address);
            rtlRow = itemView.findViewById(R.id.clickable_row);
            tvStatus = itemView.findViewById(R.id.status);

            //tvDesignation = itemView.findViewById(R.id.tvDesignation);
        }
    }
}