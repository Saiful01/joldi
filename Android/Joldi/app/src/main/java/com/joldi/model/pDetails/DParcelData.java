package com.joldi.model.pDetails;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class DParcelData {

    public String getAreaCharge() {
        return areaCharge;
    }

    public void setAreaCharge(String areaCharge) {
        this.areaCharge = areaCharge;
    }

    public int getIsOnlinePayment() {
        return isOnlinePayment;
    }

    public void setIsOnlinePayment(int isOnlinePayment) {
        this.isOnlinePayment = isOnlinePayment;
    }

    @SerializedName("is_online_payment")
    @Expose
    private int isOnlinePayment;

    @SerializedName("area_charge")
    @Expose
    private String areaCharge;

    @SerializedName("parcel_id")
    @Expose
    private String parcelId;


    @SerializedName("parcel_title")
    @Expose
    private String parcelTitle;
    @SerializedName("parcel_invoice")
    @Expose
    private String parcelInvoice;
    @SerializedName("parcel_type_id")
    @Expose
    private String parcelTypeId;
    @SerializedName("payable_amount")
    @Expose
    private String payableAmount;
    @SerializedName("delivery_charge")
    @Expose
    private String deliveryCharge;
    @SerializedName("cod")
    @Expose
    private String cod;
    @SerializedName("total_amount")
    @Expose
    private String totalAmount;
    @SerializedName("is_same_day")
    @Expose
    private String isSameDay;
    @SerializedName("delivery_date")
    @Expose
    private String deliveryDate;
    @SerializedName("parcel_notes")
    @Expose
    private String parcelNotes;
    @SerializedName("created_at")
    @Expose
    private String createdAt;
    @SerializedName("updated_at")
    @Expose
    private String updatedAt;
    @SerializedName("parcel_status_id")
    @Expose
    private String parcelStatusId;
    @SerializedName("customer_id")
    @Expose
    private String customerId;
    @SerializedName("delivery_status")
    @Expose
    private String deliveryStatus;
    @SerializedName("delivery_man_id")
    @Expose
    private String deliveryManId;
    @SerializedName("is_complete")
    @Expose
    private String isComplete;
    @SerializedName("is_paid_to_merchant")
    @Expose
    private String isPaidToMerchant;
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
    @SerializedName("customer_name")
    @Expose
    private String customerName;
    @SerializedName("customer_phone")
    @Expose
    private String customerPhone;
    @SerializedName("customer_email")
    @Expose
    private String customerEmail;
    @SerializedName("customer_address")
    @Expose
    private String customerAddress;
    @SerializedName("longitude")
    @Expose
    private String longitude;
    @SerializedName("latitude")
    @Expose
    private String latitude;

    public String getParcelId() {
        return parcelId;
    }

    public void setParcelId(String parcelId) {
        this.parcelId = parcelId;
    }

    public String getParcelTitle() {
        return parcelTitle;
    }

    public void setParcelTitle(String parcelTitle) {
        this.parcelTitle = parcelTitle;
    }

    public String getParcelInvoice() {
        return parcelInvoice;
    }

    public void setParcelInvoice(String parcelInvoice) {
        this.parcelInvoice = parcelInvoice;
    }

    public String getParcelTypeId() {
        return parcelTypeId;
    }

    public void setParcelTypeId(String parcelTypeId) {
        this.parcelTypeId = parcelTypeId;
    }

    public String getPayableAmount() {
        return payableAmount;
    }

    public void setPayableAmount(String payableAmount) {
        this.payableAmount = payableAmount;
    }

    public String getDeliveryCharge() {
        return deliveryCharge;
    }

    public void setDeliveryCharge(String deliveryCharge) {
        this.deliveryCharge = deliveryCharge;
    }

    public String getCod() {
        return cod;
    }

    public void setCod(String cod) {
        this.cod = cod;
    }

    public String getTotalAmount() {
        return totalAmount;
    }

    public void setTotalAmount(String totalAmount) {
        this.totalAmount = totalAmount;
    }

    public String getIsSameDay() {
        return isSameDay;
    }

    public void setIsSameDay(String isSameDay) {
        this.isSameDay = isSameDay;
    }

    public String getDeliveryDate() {
        return deliveryDate;
    }

    public void setDeliveryDate(String deliveryDate) {
        this.deliveryDate = deliveryDate;
    }

    public String getParcelNotes() {
        return parcelNotes;
    }

    public void setParcelNotes(String parcelNotes) {
        this.parcelNotes = parcelNotes;
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

    public String getParcelStatusId() {
        return parcelStatusId;
    }

    public void setParcelStatusId(String parcelStatusId) {
        this.parcelStatusId = parcelStatusId;
    }

    public String getCustomerId() {
        return customerId;
    }

    public void setCustomerId(String customerId) {
        this.customerId = customerId;
    }

    public String getDeliveryStatus() {
        return deliveryStatus;
    }

    public void setDeliveryStatus(String deliveryStatus) {
        this.deliveryStatus = deliveryStatus;
    }

    public String getDeliveryManId() {
        return deliveryManId;
    }

    public void setDeliveryManId(String deliveryManId) {
        this.deliveryManId = deliveryManId;
    }

    public String getIsComplete() {
        return isComplete;
    }

    public void setIsComplete(String isComplete) {
        this.isComplete = isComplete;
    }

    public String getIsPaidToMerchant() {
        return isPaidToMerchant;
    }

    public void setIsPaidToMerchant(String isPaidToMerchant) {
        this.isPaidToMerchant = isPaidToMerchant;
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

    public String getCustomerName() {
        return customerName;
    }

    public void setCustomerName(String customerName) {
        this.customerName = customerName;
    }

    public String getCustomerPhone() {
        return customerPhone;
    }

    public void setCustomerPhone(String customerPhone) {
        this.customerPhone = customerPhone;
    }

    public String getCustomerEmail() {
        return customerEmail;
    }

    public void setCustomerEmail(String customerEmail) {
        this.customerEmail = customerEmail;
    }

    public String getCustomerAddress() {
        return customerAddress;
    }

    public void setCustomerAddress(String customerAddress) {
        this.customerAddress = customerAddress;
    }

    public String getLongitude() {
        return longitude;
    }

    public void setLongitude(String longitude) {
        this.longitude = longitude;
    }

    public String getLatitude() {
        return latitude;
    }

    public void setLatitude(String latitude) {
        this.latitude = latitude;
    }
}
