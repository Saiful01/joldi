package com.joldi.server;

import com.joldi.model.ResponseModel;
import com.joldi.model.login.Login;
import com.joldi.model.orderTrack.Orders;
import com.joldi.model.pDetails.DParcel;
import com.joldi.model.parcel.Parcel;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface ServerApi {


    String BASE_URL = "http://e-parcel.pixonlab.com/";


    @FormUrlEncoded
    @POST("api/parcels")
    Call<Parcel> getParcelList(@Field("delivery_man_id") int delivery_man_id,
                               @Field("access_token") String token,
                               @Field("status") String status);

    //Get Pickup Man Orders
    @FormUrlEncoded
    @POST("api/pending-collection")
    Call<Parcel> getPickUpManParcels(@Field("delivery_man_id") int delivery_man_id,
                                     @Field("access_token") String token,
                                     @Field("status") String status);//pickup_man_assigned


    @FormUrlEncoded
    @POST("api/parcel-details")
    Call<DParcel> getParcelDetails(@Field("parcel_id") String parcel_id,
                                   @Field("access_token") String token,
                                   @Field("delivery_man_id") String delivery_man_id);

    @FormUrlEncoded
    @POST("api/parcel-update")
    Call<ResponseModel> updateParcel(@Field("parcel_id") String parcel_id,
                                     @Field("access_token") String access_token,
                                     @Field("changed_by") String changed_by,
                                     @Field("status") String status,
                                     @Field("notes") String notes);


    @FormUrlEncoded
    @POST("/api/login")
    Call<Login> loginDo(@Field("phone_number") String phone_number,
                        @Field("access_token") String token,
                        @Field("password") String password);


    @FormUrlEncoded
    @POST("api/parcels")
    Call<Orders> getParcels(@Field("delivery_man_id") String delivery_man_id,
                            @Field("app_secret_key") String app_secret_key,
                            @Field("status") String status);


    @FormUrlEncoded
    @POST("api/parcel/tracking")
    Call<Orders> getParcelByPhoneNumber(@Field("customer_phone") String delivery_man_id,
                                        @Field("app_secret_key") String app_secret_key,
                                        @Field("status") String status);


    @FormUrlEncoded
    @POST("api/parcel-collect")
    Call<ResponseModel> parcelCollect(@Field("invoice_number") String invoice_number,
                                      @Field("access_token") String access_token,
                                      @Field("changed_by") String changed_by,
                                      @Field("status") String status,//accepted
                                      @Field("notes") String notes);


    @FormUrlEncoded
    @POST("api/parcel-collect-from-hub")
    Call<ResponseModel> parcelCollectFromHub(@Field("invoice_number") String invoice_number,
                                             @Field("access_token") String access_token,
                                             @Field("changed_by") String changed_by,
                                             @Field("status") String status,//on_the_way
                                             @Field("notes") String notes);

    @FormUrlEncoded
    @POST("api/location/store")
    Call<Login> sendLocation(@Field("latitude") String latitude,
                             @Field("longitude") String longitude,
                             @Field("my_address") String my_address,
                             @Field("delivery_man_id") String delivery_man_id,//on_the_way
                             @Field("token") String token);


    @FormUrlEncoded
    @POST("api/partial-deliver/store")
    Call<ResponseModel> partialParcelDeliver(@Field("parcel_id") String parcel_id,
                                             @Field("access_token") String access_token,
                                             @Field("changed_by") String changed_by,
                                             @Field("status") String status,//partial_deliver
                                             @Field("notes") String notes,
                                             @Field("amount") String amount);

}
