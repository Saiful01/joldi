package com.joldi.model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class Report {

    @SerializedName("status_code")
    @Expose
    private Integer statusCode;
    @SerializedName("message")
    @Expose
    private String message;
    @SerializedName("access_token")
    @Expose
    private String accessToken;
    @SerializedName("cancelled_parcels")
    @Expose
    private Integer cancelledParcels;
    @SerializedName("ongoing_parcels")
    @Expose
    private Integer ongoingParcels;
    @SerializedName("delivered_parcels")
    @Expose
    private Integer deliveredParcels;
    @SerializedName("assigned_parcels")
    @Expose
    private Integer assignedParcels;

    public Integer getStatusCode() {
        return statusCode;
    }

    public void setStatusCode(Integer statusCode) {
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

    public Integer getCancelledParcels() {
        return cancelledParcels;
    }

    public void setCancelledParcels(Integer cancelledParcels) {
        this.cancelledParcels = cancelledParcels;
    }

    public Integer getOngoingParcels() {
        return ongoingParcels;
    }

    public void setOngoingParcels(Integer ongoingParcels) {
        this.ongoingParcels = ongoingParcels;
    }

    public Integer getDeliveredParcels() {
        return deliveredParcels;
    }

    public void setDeliveredParcels(Integer deliveredParcels) {
        this.deliveredParcels = deliveredParcels;
    }

    public Integer getAssignedParcels() {
        return assignedParcels;
    }

    public void setAssignedParcels(Integer assignedParcels) {
        this.assignedParcels = assignedParcels;
    }

}
