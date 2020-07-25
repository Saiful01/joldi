package com.joldi.model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class ResponseModel {


    public int getTotalPayable() {
        return payableAmount;
    }

    public void setPayableAmount(int payableAmount) {
        this.payableAmount = payableAmount;
    }

    @SerializedName("payable_amount")
    @Expose
    private int payableAmount;


    @SerializedName("joldi_charge")
    @Expose
    private int joldiCharge;

    @SerializedName("is_online_payment")
    @Expose
    private int isOnlinePayment;

    @SerializedName("status_code")
    @Expose
    private String statusCode;
    @SerializedName("message")
    @Expose
    private String message;
    @SerializedName("access_token")
    @Expose
    private String accessToken;

    @SerializedName("data")


    public int getIsOnlinePayment() {
        return isOnlinePayment;
    }

    public void setIsOnlinePayment(int isOnlinePayment) {
        this.isOnlinePayment = isOnlinePayment;
    }

    public double getJoldiCharge() {
        return joldiCharge;
    }

    public void setJoldiCharge(int joldiCharge) {
        this.joldiCharge = joldiCharge;
    }



    public String getStatusCode() {
        return statusCode;
    }

    public void setStatusCode(String statusCode) {
        this.statusCode = statusCode;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }

    public String getAccessToken() {
        return accessToken;
    }

    public void setAccessToken(String accessToken) {
        this.accessToken = accessToken;
    }


}
