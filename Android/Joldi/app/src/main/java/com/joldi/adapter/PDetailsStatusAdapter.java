package com.joldi.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.joldi.model.pDetails.DStatus;
import com.joldi.parcel.R;
import com.joldi.utils.CommonUtils;

import java.util.List;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

public class PDetailsStatusAdapter extends RecyclerView.Adapter<PDetailsStatusAdapter.ViewHolder> {

    private Context mContext;
    private List<DStatus> statusList;

    public PDetailsStatusAdapter(Context mContext, List<DStatus> statusList) {
        this.mContext = mContext;
        this.statusList = statusList;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View view = LayoutInflater.from(mContext).inflate(R.layout.status_item, parent, false);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, final int position) {
        holder.tvInvoice.setText(statusList.get(position).getParcelInvoice());
        holder.tvDate.setText(statusList.get(position).getCreatedAt());
        holder.tvStatus.setText(statusList.get(position).getParcelStatus());

        if (statusList.get(position).getParcelStatus().equals(CommonUtils.getDelivered())) {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_green);
        } else if (statusList.get(position).getParcelStatus().equals(CommonUtils.getPending())) {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_yellow);
        } else if (statusList.get(position).getParcelStatus().equals(CommonUtils.getCancelled())) {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_red);
        } else if (statusList.get(position).getParcelStatus().equals(CommonUtils.getReturendParcel())) {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_red);
        } else {
            holder.tvStatus.setBackgroundResource(R.drawable.bg_blue);
        }

      /*  holder.tvInvoice.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(mContext, statusList.get(position).getName(), Toast.LENGTH_SHORT).show();
            }
        });*/
    }

    @Override
    public int getItemCount() {
        return statusList.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder {

        TextView tvInvoice, tvDate, tvStatus;

        public ViewHolder(@NonNull View itemView) {
            super(itemView);
            tvInvoice = itemView.findViewById(R.id.invoice_number);
            tvDate = itemView.findViewById(R.id.date);
            tvStatus = itemView.findViewById(R.id.status);
            //tvDesignation = itemView.findViewById(R.id.tvDesignation);
        }
    }
}
