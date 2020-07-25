package com.joldi.ui;

import android.Manifest;
import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.location.Address;
import android.location.Geocoder;
import android.location.Location;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.github.mikephil.charting.charts.PieChart;
import com.github.mikephil.charting.components.Legend;
import com.github.mikephil.charting.data.PieData;
import com.github.mikephil.charting.data.PieDataSet;
import com.github.mikephil.charting.data.PieEntry;
import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GoogleApiAvailability;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.location.LocationListener;
import com.google.android.gms.location.LocationRequest;
import com.google.android.gms.location.LocationServices;
import com.joldi.model.login.Login;
import com.joldi.parcel.R;
import com.joldi.server.ServerApi;
import com.joldi.ui.parcel.ParcelActivity;
import com.joldi.utils.CommonUtils;
import com.joldi.utils.SharedPrefClass;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.core.app.ActivityCompat;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class HomeActivity extends AppCompatActivity
    implements GoogleApiClient.ConnectionCallbacks,
    GoogleApiClient.OnConnectionFailedListener, LocationListener {
    private Location location;
    PieChart pieChart;
    TextView tvName, tvLocation;
    ProgressDialog progressDoalog;

    private GoogleApiClient googleApiClient;
    private static final int PLAY_SERVICES_RESOLUTION_REQUEST = 9000;
    private LocationRequest locationRequest;
    private static final long UPDATE_INTERVAL = 5000, FASTEST_INTERVAL = 5000; // = 5 seconds
    // lists for permissions
    private ArrayList<String> permissionsToRequest;
    private ArrayList<String> permissionsRejected = new ArrayList<>();
    private ArrayList<String> permissions = new ArrayList<>();
    // integer for permissions results request
    private static final int ALL_PERMISSIONS_RESULT = 1011;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);

        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        tvName = findViewById(R.id.name);
        tvLocation = findViewById(R.id.location);
        tvName.setText(SharedPrefClass.getName(getApplicationContext()));
        setTitle(getString(R.string.home));

       /* pieChart = (PieChart) findViewById(R.id.pie_chart);
        //pieChart.setDescription(" Sales by employee In thousands $");
        pieChart.setRotationEnabled(true);
        pieChart.setHoleRadius(25f);
        pieChart.setTransparentCircleAlpha(0);
        pieChart.setCenterText("super cool chart");
        pieChart.setCenterTextSize(10);
        pieChart.setDrawEntryLabels(true);*/

        // gerenrateChart();


        // we add permissions we need to request location of the users
        permissions.add(Manifest.permission.ACCESS_FINE_LOCATION);
        permissions.add(Manifest.permission.ACCESS_COARSE_LOCATION);


        permissionsToRequest = permissionsToRequest(permissions);

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if (permissionsToRequest.size() > 0) {
                requestPermissions(permissionsToRequest.toArray(new String[permissionsToRequest.size()]), ALL_PERMISSIONS_RESULT);
            }
        }

        // we build google api client

        googleApiClient = new GoogleApiClient.Builder(this).
            addApi(LocationServices.API).
            addConnectionCallbacks(this).
            addOnConnectionFailedListener(this).build();

    }

    private void gerenrateChart() {


        ArrayList<PieEntry> yEntrys = new ArrayList<>();
        ArrayList<String> xEntrys = new ArrayList<>();


        yEntrys.add(new PieEntry(15));

        yEntrys.add(new PieEntry(10));
        yEntrys.add(new PieEntry(20));


        xEntrys.add("M");
        xEntrys.add("N");
        xEntrys.add("O");


        //create the DATA

        PieDataSet pieDataSet = new PieDataSet(yEntrys, "Beachs");
        pieDataSet.setSliceSpace(2);
        pieDataSet.setValueTextSize(12);


        //add colors to dataSet

        ArrayList<Integer> colors = new ArrayList<>();
        colors.add(Color.BLUE);
        colors.add(Color.RED);
        colors.add(Color.CYAN);

        pieDataSet.setColors(colors);

        pieDataSet.setSliceSpace(25);


        //add legend to chart

        Legend legend = pieChart.getLegend();
        legend.setForm(Legend.LegendForm.CIRCLE);


        //create a pieData object

        PieData pieData = new PieData(pieDataSet);


        pieChart.setData(pieData);

        pieChart.invalidate();
    }


    public void pendingOrder(View view) {

        Intent intent = new Intent(getApplicationContext(), ParcelActivity.class);
        intent.putExtra("status", CommonUtils.getOnTheWay());
        intent.putExtra("title", "Pending Parcels");
        startActivity(intent);
        //Toast.makeText(this, "Hello", Toast.LENGTH_SHORT).show();

    }

    public void deliveredOrder(View view) {

        Intent intent = new Intent(getApplicationContext(), ParcelActivity.class);
        intent.putExtra("status", CommonUtils.getDelivered());
        intent.putExtra("title", "Delivered Parcels");
        startActivity(intent);


    }

    public void collectParcel(View view) {

        Intent intent = new Intent(getApplicationContext(), CollectParcelActivity.class);
        startActivity(intent);

    }

    public void allParcel(View view) {


        Intent intent = new Intent(getApplicationContext(), ParcelActivity.class);
        intent.putExtra("status", CommonUtils.getAll());
        intent.putExtra("title", "All Parcels");
        startActivity(intent);
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.add:
                //add the function to perform here
                return (true);
            case R.id.action_settings:
                //add the function to perform her
                return (true);
            case R.id.action_logout:
                //add the function to perform here
                SharedPrefClass.ClearPreference(getApplicationContext());
                startActivity(new Intent(getApplicationContext(), LoginActivity.class));
                return (true);
            case R.id.report:
                startActivity(new Intent(getApplicationContext(), ReportActivity.class));
                return (true);
            case R.id.manual_collection:
                startActivity(new Intent(getApplicationContext(), ManualCollectionActivity.class));
                return (true);
            case R.id.manual_collection_from_hub:
                startActivity(new Intent(getApplicationContext(), ManualCollectFromHub.class));
                return (true);
        }
        return (super.onOptionsItemSelected(item));
    }

    public void collectFromHub(View view) {
        startActivity(new Intent(getApplicationContext(), CollectFromHubActivity.class));

    }

    public void pendingCollection(View view) {


        Intent intent = new Intent(getApplicationContext(), ParcelActivity.class);
        intent.putExtra("status", CommonUtils.getPickUpAssigned());
        intent.putExtra("title", "Collectible Parcels");
        startActivity(intent);
    }

    private ArrayList<String> permissionsToRequest(ArrayList<String> wantedPermissions) {
        ArrayList<String> result = new ArrayList<>();

        for (String perm : wantedPermissions) {
            if (!hasPermission(perm)) {
                result.add(perm);
            }
        }

        return result;
    }

    private boolean hasPermission(String permission) {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            return checkSelfPermission(permission) == PackageManager.PERMISSION_GRANTED;
        }
        return true;
    }

    @Override
    protected void onStart() {
        super.onStart();

        if (googleApiClient != null) {
            googleApiClient.connect();
        }
    }

    @Override
    protected void onResume() {
        super.onResume();

        if (!checkPlayServices()) {
            tvLocation.setText("You need to install Google Play Services to use the App properly");
        }
    }

    @Override
    protected void onPause() {
        super.onPause();

        // stop location updates
        if (googleApiClient != null && googleApiClient.isConnected()) {
            LocationServices.FusedLocationApi.removeLocationUpdates(googleApiClient, (com.google.android.gms.location.LocationListener) this);
            googleApiClient.disconnect();
        }
    }

    private boolean checkPlayServices() {
        GoogleApiAvailability apiAvailability = GoogleApiAvailability.getInstance();
        int resultCode = apiAvailability.isGooglePlayServicesAvailable(this);

        if (resultCode != ConnectionResult.SUCCESS) {
            if (apiAvailability.isUserResolvableError(resultCode)) {
                apiAvailability.getErrorDialog(this, resultCode, PLAY_SERVICES_RESOLUTION_REQUEST);
            } else {
                finish();
            }

            return false;
        }

        return true;
    }

    @Override
    public void onConnected(@Nullable Bundle bundle) {

        Log.d("MOTIUR", "OnConnected adn started");
        if (ActivityCompat.checkSelfPermission(this,
            Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED
            && ActivityCompat.checkSelfPermission(this,
            Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            return;
        }

        // Permissions ok, we get last location
        location = LocationServices.FusedLocationApi.getLastLocation(googleApiClient);

        if (location != null) {
            //tvLocation.setText("Latitude ");

            //Toast.makeText(getApplicationContext(), "Latitude : " + location.getLatitude() + "\nLongitude : " + location.getLongitude(), Toast.LENGTH_SHORT).show();

            Geocoder geocoder;
            List<Address> addresses;
            geocoder = new Geocoder(this, Locale.getDefault());

            try {
                addresses = geocoder.getFromLocation(location.getLatitude(), location.getLongitude(), 1); // Here 1 represent max location result to returned, by documents it recommended 1 to 5
                String address = addresses.get(0).getAddressLine(0); // If any additional address line present than only, check with max available address lines by getMaxAddressLineIndex()
                String city = addresses.get(0).getLocality();
                String state = addresses.get(0).getAdminArea();
                String country = addresses.get(0).getCountryName();
                String postalCode = addresses.get(0).getPostalCode();
                String knownName = addresses.get(0).getFeatureName();
                String my_address = knownName + ", " + city + ", " + state + ", " + country + ", ";

                tvLocation.setText(my_address);
                //sendLocationToServer(location.getLatitude(), location.getLongitude(), my_address);
                sendLocationToServer(location.getLatitude(), location.getLongitude(), my_address);
            } catch (IOException e) {
                e.printStackTrace();
            }

        }


        //startLocationUpdates();
    }


    private void startLocationUpdates() {
        locationRequest = new LocationRequest();
        locationRequest.setPriority(LocationRequest.PRIORITY_HIGH_ACCURACY);
        locationRequest.setInterval(UPDATE_INTERVAL);
        locationRequest.setFastestInterval(FASTEST_INTERVAL);

        if (ActivityCompat.checkSelfPermission(this,
            Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED
            && ActivityCompat.checkSelfPermission(this,
            Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            Toast.makeText(this, "You need to enable permissions to display location !", Toast.LENGTH_SHORT).show();
        }

        LocationServices.FusedLocationApi.requestLocationUpdates(googleApiClient, locationRequest, (com.google.android.gms.location.LocationListener) this);
    }

    @Override
    public void onConnectionSuspended(int i) {
    }

    @Override
    public void onConnectionFailed(@NonNull ConnectionResult connectionResult) {
    }

    @Override
    public void onLocationChanged(Location location) {
        Log.d("MOTIUR", "Location Changed");

        if (location != null) {

            Geocoder geocoder;
            List<Address> addresses;
            geocoder = new Geocoder(this, Locale.getDefault());

            try {
                addresses = geocoder.getFromLocation(location.getLatitude(), location.getLongitude(), 1); // Here 1 represent max location result to returned, by documents it recommended 1 to 5
                String address = addresses.get(0).getAddressLine(0); // If any additional address line present than only, check with max available address lines by getMaxAddressLineIndex()
                String city = addresses.get(0).getLocality();
                String state = addresses.get(0).getAdminArea();
                String country = addresses.get(0).getCountryName();
                String postalCode = addresses.get(0).getPostalCode();
                String knownName = addresses.get(0).getFeatureName();
                String my_address = knownName + ", " + city + ", " + state + ", " + country + ", ";

                tvLocation.setText(my_address);
                sendLocationToServer(location.getLatitude(), location.getLongitude(), my_address);

            } catch (IOException e) {
                e.printStackTrace();
            }
            //saveLocation(location.getLatitude(), location.getLongitude(), SharedPrefClass.getEmployeeId(getApplicationContext()));
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        switch (requestCode) {
            case ALL_PERMISSIONS_RESULT:
                for (String perm : permissionsToRequest) {
                    if (!hasPermission(perm)) {
                        permissionsRejected.add(perm);
                    }
                }

                if (permissionsRejected.size() > 0) {
                    if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
                        if (shouldShowRequestPermissionRationale(permissionsRejected.get(0))) {
                            new AlertDialog.Builder(HomeActivity.this).
                                setMessage("These permissions are mandatory to get your location. You need to allow them.").
                                setPositiveButton("OK", new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialogInterface, int i) {
                                        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
                                            requestPermissions(permissionsRejected.
                                                toArray(new String[permissionsRejected.size()]), ALL_PERMISSIONS_RESULT);
                                        }

                                    }
                                }).setNegativeButton("Cancel", null).create().show();

                            return;
                        }
                    }
                } else {
                    if (googleApiClient != null) {

                        //restartActivity();
                        googleApiClient.connect();
                    }
                }

                break;
        }
    }


    private void sendLocationToServer(double latitude, double longitude, String my_address) {

        Log.d("MOTIUR", "Location Send to server");
        Retrofit retrofit = new Retrofit.Builder()
            .baseUrl(ServerApi.BASE_URL)
            .addConverterFactory(GsonConverterFactory.create()) //Here we are using the GsonConverterFactory to directly convert json data to object
            .build();

        ServerApi api = retrofit.create(ServerApi.class);

        Call<Login> call = api.sendLocation(latitude + "", longitude + "", my_address, SharedPrefClass.getDeliverymanId(getApplicationContext()) + "", CommonUtils.getToken());

        call.enqueue(new Callback<Login>() {
            @SuppressLint("ResourceAsColor")
            @Override
            public void onResponse(Call<Login> call, Response<Login> response) {


                if (response.body() != null) {
                    if (response.isSuccessful()) {
                        //CommonUtils.message(getApplicationContext(), "Successfully Updated");
                    }
                } else {
                    Log.d("MOTIUR", response.body() + "");
                }
            }

            @Override
            public void onFailure(Call<Login> call, Throwable t) {

                CommonUtils.message(getApplicationContext(), "There is an error" + t.getMessage());
            }
        });

    }

}
