package com.example.mapexplorer;

import android.os.Bundle;
import android.view.View;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

public class MainActivity extends AppCompatActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    private static final float ZOOM_LEVEL = 15.0f;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.mapView);
        mapFragment.getMapAsync(this);

        // Set up button click listeners
        findViewById(R.id.zoomInButton).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                zoomIn();
            }
        });

        findViewById(R.id.zoomOutButton).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                zoomOut();
            }
        });

        findViewById(R.id.satelliteViewButton).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                switchToSatelliteView();
            }
        });

        findViewById(R.id.terrainViewButton).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                switchToTerrainView();
            }
        });
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        // Add a marker in the current location and move the camera
        LatLng currentLocation = new LatLng(37.7749, -122.4194); // Example coordinates for San Francisco
        mMap.addMarker(new MarkerOptions().position(currentLocation).title("Current Location"));
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(currentLocation, ZOOM_LEVEL));
    }

    private void zoomIn() {
        if (mMap != null) {
            float currentZoom = mMap.getCameraPosition().zoom;
            mMap.animateCamera(CameraUpdateFactory.zoomTo(currentZoom + 1));
        }
    }

    private void zoomOut() {
        if (mMap != null) {
            float currentZoom = mMap.getCameraPosition().zoom;
            mMap.animateCamera(CameraUpdateFactory.zoomTo(currentZoom - 1));
        }
    }

    private void switchToSatelliteView() {
        if (mMap != null) {
            mMap.setMapType(GoogleMap.MAP_TYPE_SATELLITE);
        }
    }

    private void switchToTerrainView() {
        if (mMap != null) {
            mMap.setMapType(GoogleMap.MAP_TYPE_TERRAIN);
        }
    }
}