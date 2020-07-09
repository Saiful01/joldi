package com.joldi.model.pDetails;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class DStatus {

    @SerializedName("parcel_status_history_id")
    @Expose
    private String parcelStatusHistoryId;

    @SerializedName("notes")
    @Expose
    private String notes;

    @SerializedName("message")
    @Expose
    private String message;
    @SerializedName("parcel_status")
    @Expose
    private String parcelStatus;
    @SerializedName("changed_by")
    @Expose
    private String changedBy;
    @SerializedName("parcel_id")
    @Expose
    private String parcelId;
    @SerializedName("user_type")
    @Expose
    private String userType;
    @SerializedName("created_at")
    @Expose
    private String createdAt;
    @SerializedName("updated_at")
    @Expose
    private String updatedAt;
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

    public DStatus(String parcelStatusHistoryId, String notes, String message, String parcelStatus, String changedBy, String parcelId, String userType, String createdAt, String updatedAt, String parcelTitle, String parcelInvoice, String parcelTypeId, String payableAmount, String deliveryCharge, String cod, String totalAmount, String isSameDay, String deliveryDate, String parcelNotes) {
        this.parcelStatusHistoryId = parcelStatusHistoryId;
        this.notes = notes;
        this.message = message;
        this.parcelStatus = parcelStatus;
        this.changedBy = changedBy;
        this.parcelId = parcelId;
        this.userType = userType;
        this.createdAt = createdAt;
        this.updatedAt = updatedAt;
        this.parcelTitle = parcelTitle;
        this.parcelInvoice = parcelInvoice;
        this.parcelTypeId = parcelTypeId;
        this.payableAmount = payableAmount;
        this.deliveryCharge = deliveryCharge;
        this.cod = cod;
        this.totalAmount = totalAmount;
        this.isSameDay = isSameDay;
        this.deliveryDate = deliveryDate;
        this.parcelNotes = parcelNotes;
    }



    public DStatus(String parcelInvoice, String createdAt, String message,String parcelStatus) {
        this.parcelInvoice=parcelInvoice;
        this.createdAt=createdAt;
        this.message=message;
        this.parcelStatus=parcelStatus;
    }

    public String getParcelStatusHistoryId() {
        return parcelStatusHistoryId;
    }

    public void setParcelStatusHistoryId(String parcelStatusHistoryId) {
        this.parcelStatusHistoryId = parcelStatusHistoryId;
    }

    public String getNotes() {
        return notes;
    }

    public void setNotes(String notes) {
        this.notes = notes;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }

    public String getParcelStatus() {
        return parcelStatus;
    }

    public void setParcelStatus(String parcelStatus) {
        this.parcelStatus = parcelStatus;
    }

    public String getChangedBy() {
        return changedBy;
    }

    public void setChangedBy(String changedBy) {
        this.changedBy = changedBy;
    }

    public String getParcelId() {
        return parcelId;
    }

    public void setParcelId(String parcelId) {
        this.parcelId = parcelId;
    }

    public String getUserType() {
        return userType;
    }

    public void setUserType(String userType) {
        this.userType = userType;
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

}
