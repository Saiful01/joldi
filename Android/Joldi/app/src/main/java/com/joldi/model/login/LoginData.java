package com.joldi.model.login;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class LoginData {


    @SerializedName("delivery_man_id")
    @Expose
    private Integer deliveryManId;
    @SerializedName("delivery_man_name")
    @Expose
    private String deliveryManName;
    @SerializedName("delivery_man_phone")
    @Expose
    private String deliveryManPhone;
    @SerializedName("password")
    @Expose
    private String password;
    @SerializedName("delivery_man_address")
    @Expose
    private String deliveryManAddress;
    @SerializedName("active_status")
    @Expose
    private String activeStatus;
    @SerializedName("created_at")
    @Expose
    private String createdAt;
    @SerializedName("updated_at")
    @Expose
    private String updatedAt;

    public Integer getDeliveryManId() {
        return deliveryManId;
    }

    public void setDeliveryManId(Integer deliveryManId) {
        this.deliveryManId = deliveryManId;
    }

    public String getDeliveryManName() {
        return deliveryManName;
    }

    public void setDeliveryManName(String deliveryManName) {
        this.deliveryManName = deliveryManName;
    }

    public String getDeliveryManPhone() {
        return deliveryManPhone;
    }

    public void setDeliveryManPhone(String deliveryManPhone) {
        this.deliveryManPhone = deliveryManPhone;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getDeliveryManAddress() {
        return deliveryManAddress;
    }

    public void setDeliveryManAddress(String deliveryManAddress) {
        this.deliveryManAddress = deliveryManAddress;
    }

    public String getActiveStatus() {
        return activeStatus;
    }

    public void setActiveStatus(String activeStatus) {
        this.activeStatus = activeStatus;
    }

    public String getCreatedAt() {
        return createdAt;
    }

    public void setCreatedAt(String createdAt) {
        this.createdAt = createdAt;
    }

    public String getUpdatedAt() {
        return updatedAt;
    }

    public void setUpdatedAt(String updatedAt) {
        this.updatedAt = updatedAt;
    }


}
