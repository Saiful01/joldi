package com.joldi.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.joldi.model.orderTrack.OrderData;
import com.joldi.parcel.R;
import com.joldi.utils.CommonUtils;

import java.util.List;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class TrackingAdapter extends RecyclerView.Adapter<TrackingAdapter.ViewHolder> {

    private Context mContext;
    private List<OrderData> trackingList;

    public TrackingAdapter(Context mContext, List<OrderData> trackingList) {
        this.mContext = mContext;
        this.trackingList = trackingList;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View view = LayoutInflater.from(mContext).inflate(R.layout.tracking_item, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, final int position) {
        holder.tvInvoice.setText("#" + trackingList.get(position).getParcelInvoice());
        holder.tvDate.setText(trackingList.get(position).getCreatedAt());
        holder.tvStatus.setText(trackingList.get(position).getDeliveryStatus());
        holder.tvPhone.setText(trackingList.get(position).getDeliveryManPhone());

        if (trackingList.get(position).getDeliveryStatus().equals(CommonUtils.getDelivered())) {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_green);
        } else if (trackingList.get(position).getDeliveryStatus().equals(CommonUtils.getPending())) {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_yellow);
        } else if (trackingList.get(position).getDeliveryStatus().equals(CommonUtils.getCancelled())) {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_red);
        } else if (trackingList.get(position).getDeliveryStatus().equals(CommonUtils.getReturendParcel())) {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_red);
        } else {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_blue);
        }

      /*  holder.tvInvoice.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(mContext, trackingList.get(position).getName(), Toast.LENGTH_SHORT).show();
            }
        });*/
    }

    @Override
    public int getItemCount() {
        return trackingList.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder {

        TextView tvInvoice, tvDate, tvStatus, tvPhone;

        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            tvInvoice = itemView.findViewById(R.id.invoice_number);
            tvDate = itemView.findViewById(R.id.date);
            tvStatus = itemView.findViewById(R.id.status);
            tvPhone = itemView.findViewById(R.id.phone_number);
        }
    }
}