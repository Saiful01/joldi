package com.joldi.model.pDetails;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

import java.util.List;

public class DParcel {
    @SerializedName("status_code")
    @Expose
    private Integer statusCode;
    @SerializedName("message")
    @Expose
    private String message;
    @SerializedName("access_token")
    @Expose
    private String accessToken;
    @SerializedName("data")
    @Expose
    private DParcelData data;
    @SerializedName("statuses")
    @Expose
    private List<DStatus> statuses = null;

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

    public DParcelData getData() {
        return data;
    }

    public void setData(DParcelData data) {
        this.data = data;
    }

    public List<DStatus> getStatuses() {
        return statuses;
    }

    public void setStatuses(List<DStatus> statuses) {
        this.statuses = statuses;
    }

}

