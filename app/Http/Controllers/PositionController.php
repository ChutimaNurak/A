<?php
namespace App\Http\Controllers;
use App\PositionModel;
use Illuminate\Http\Request;

class PositionController extends Controller {
 
    public function index(Request $request) {
            $model = new PositionModel();
            $q = $request->input('q');        
            $table_position = $model->select_search($q);
            $data = ['table_position' => $table_position,'q' => $q ];     

        return view('position/index',$data); 
    }

    public function create(Request $request) {
            $id = $request->input('ID');
            $data =['ID' => $id];

        return view('position/create',$data);
    }


    public function store(Request $request) {
            $id = $request->input('ID');
            $house_number = $request->input('House_number');
            $village = $request->input('Village');
            $subdistrict = $request->input('Subdistrict');
            $city = $request->input('City');
            $province = $request->input('Province');
            $zip_code = $request->input('Zip_code');
            $latitude = $request->input('Latitude');
            $longitude = $request->input('Longitude');

            $model = new PositionModel();
            $model->insert($id, $house_number, $village, $subdistrict, $city, $province, $zip_code, 
                $latitude, $longitude);

        return redirect("/customer/{$id}");

    }
   
    public function show($id_position) {
            $model = new PositionModel();        
            $table_position = $model->select_id($id_position);       
            $data = ['table_position' => $table_position]; 

        return view('position/show',$data); 
    }
    
    public function edit($id_position) {
            $model = new PositionModel();        
            $table_position = $model->select_id($id_position);        
            $data = ['table_position' => $table_position];   

        return view('position/edit',$data); 
    }
    
    public function update(Request $request, $id_position){
            $id = $request->input('ID');        
            $house_number = $request->input('House_number');        
            $village = $request->input('Village');        
            $subdistrict = $request->input('Subdistrict');
            $city = $request->input('City');        
            $province = $request->input('Province');        
            $zip_code = $request->input('Zip_code');        
            $latitude = $request->input('Latitude');
            $longitude = $request->input('Longitude');

            $model = new PositionModel();        
            $model->update($id, $house_number, $village, $subdistrict, $city, $province, $zip_code, 
                $latitude, $longitude, $id_position);

        return redirect("/customer/{$id}"); 
    }

    
    public function destroy(Request $request, $id_position) {
           $model = new PositionModel();        
           $model->delete($id_position);
           $id = $request->input('ID');

        return redirect("/customer/{$id}");
    }
}