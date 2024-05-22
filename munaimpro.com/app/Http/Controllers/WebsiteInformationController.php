<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Logo;
use App\Models\Post;
use App\Models\User;
use App\Models\Message;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use App\Models\VisitorInformations;
use Illuminate\Support\Facades\Storage;

class WebsiteInformationController extends Controller
{
    /* Method for admin dashboard page */

    public function adminDashboardPage(){
        
    }


    /* Method for admin dashboard statistics */

    public function dashboardSummaryInfo(){
        // Total user
        $total_user = User::all()->count();
        // Total portfolio
        $total_portfolio = Portfolio::all()->count();
        // Total category
        $total_category = Category::all()->count();
        // Total post
        $total_post = Post::all()->count();
        // Total visitor
        $total_visitor = VisitorInformations::all()->count();
        // Total new message
        $total_message = Message::all()->count();

        return response()->json([
            'total_user' => $total_user,
            'total_portfolio' => $total_portfolio,
            'total_category' => $total_category,
            'total_post' => $total_post,
            'total_visitor' => $total_visitor,
            'total_message' => $total_message,
        ]);
    }


    /* Method for admin logo & seo property page */

    public function adminLogoWithSEOPropertyPage(){
        
    }


    /* Method for retrieve logo */
    
    public function retrieveLogoInfo(){
        try{
            $logo = Logo::get(); // Primary key id from logo table
            
            if($logo){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Request success',
                    'data' => $logo
                ]);
            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Data not found'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.' '.$e->getMessage()
            ]);
        }
        
    }


    /* Method for logo insert */

    public function addLogoInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'logo' => 'required|image|mimes:png,jpg,jpeg',
            ]);

            if($request->hasFile('logo')){
                /* Getting file */
                $logoImage = $request->file('logo');

                /* Extract the original file name with extension */
                $logoName = $logoImage->getClientOriginalName();

                /* Merge logo image into array */
                $logoData = array_merge($validatedData, ['logo' => $logoName]);
                
                $logo = Logo::create($logoData);

                /* Store logo image into storage/public/website_logo folder */
                if ($logo){
                    $logoImage->storeAs('website_logo', $logoName, 'public');
                }
            }
        
            return response()->json([
                'status' => 'success',
                'message' => 'New logo added'
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'.$e->getMessage()
            ]);
        }
    }


    /* Method for logo update */

    public function updateLogoInfo(Request $request){
        try{
            $logoId = Logo::pluck('id')->first();

            // Input validation process for backend
            $validatedData = $request->validate([
                'logo' => 'required|image|mimes:png,jpg,jpeg',
            ]);

            if($request->hasFile('logo')){
                // Retrive logo link from database
                $getPreviousLogoImage = Logo::where('id', '=', $logoId)->first('logo');

                // Remove logo file from storage
                if($getPreviousLogoImage){
                    if(Storage::exists("public/website_logo/".$getPreviousLogoImage->logo)){
                        Storage::delete("public/website_logo/".$getPreviousLogoImage->logo);
                    }
                }

                /* Getting new file */
                $logoImage = $request->file('logo');

                /* Extract the original file name with extension */
                $logoName = $logoImage->getClientOriginalName();

                /* Merge logo image into array */
                $logoData = array_merge($validatedData, ['logo' => $logoName]);
                
                $logo = Logo::where('id',$logoId)->update($logoData);

                /* Store logo image into storage/public/website_logo folder */
                if ($logo){
                    $logoImage->storeAs('website_logo', $logoName, 'public');
                }
            }
        
            return response()->json([
                'status' => 'success',
                'message' => 'Logo updated'
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'.$e->getMessage()
            ]);
        }
    }


    /* Method for retrieve SEO property */
    
    public function retriveAllSeoPropertyInfo(){
        try{
            $seoproperty = Seoproperty::get(['page_name', 'site_title', 'site_keywords', 'site_description']);
            
            if($seoproperty){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Request success',
                    'data' => $seoproperty
                ]);
            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Data not found'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.' '.$e->getMessage()
            ]);
        }
        
    }


    /* Method for retrive SEO property information by id */

    public function retriveSeoPropertyInfoById(Request $request){
        try{
            $seopropertyInfoId = $request->input('seoproperty_info_id'); // Primary key id from input
        
            $seoproperty = Seoproperty::findOrFail($seopropertyInfoId, ['page_name', 'site_title', 'site_keywords', 'site_description', 'og_site_name', 'og_url', 'og_title', 'og_description', 'og_image']); // Getting SEO property data by id

            if($seoproperty){
                return response()->json([
                    'status' => 'success',
                    'message' => 'SEO property data found',
                    'data' => $seoproperty,
                ]);
            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Something went wrong'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.$e->getMessage()
            ]);
        }

    }



    /* Method for update SEO property information */

    public function updateSeoPropertyInfo(Request $request){
        try{
            // Input validation process for backend
            $validatedData = $request->validate([
                'page_name' => 'required|string|',
                'site_title' => 'required|string|max:50',
                'site_keywords' => 'required|string|max:255',
                'site_description' => 'required|string',
                'og_site_name' => 'required|string|max:100',
                'og_url' => 'required|string|max:100',
                'og_title' => 'required|string|max:100',
                'og_description' => 'required|string',
                'og_image' => 'image|mimes:png,jpg,jpeg',
            ]);

            $seopropertyId = $request->input('seoproperty_info_id');

            if($request->hasFile('og_image')){
                // Retrive og image link from database
                $getPreviousOGImage = SeoProperty::where('id', '=', $seopropertyId)->first('og_image');

                // Remove og image file from storage
                if($getPreviousOGImage){
                    if(Storage::exists("public/website_pictures/open_graph_images/".$getPreviousOGImage->og_image)){
                        Storage::delete("public/website_pictures/open_graph_images/".$getPreviousOGImage->og_image);
                    }
                }

                // Getting new og file
                $ogImage = $request->file('og_image');

                /* Extract the original file name with extension */
                $ogImageName = $ogImage->getClientOriginalName();

                $seopropertyData = array_merge($validatedData, ['og_image' => $ogImageName]);

                $seoproperty = Seoproperty::where('id', '=', $seopropertyId)->update($seopropertyData);

                if($seoproperty){
                    $ogImage->storeAs('website_pictures/open_graph_images', $ogImageName, 'public');
                }

            } else{
                Seoproperty::where('id', '=', $seopropertyId)->update($validatedData);
            }
        
            return response()->json([
                'status' => 'success',
                'message' => 'SEO information updated successfully'
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'.$e->getMessage()
            ]);
        }
    }


    /* Method for retrieve website visitor information */
    
    public function retriveAllVisitorInfo(){
        try{
            $visitor = VisitorInformations::get(['id_address', 'visitor_country', 'visitor_browser', 'total_visit', 'last_visiting_time']);
            
            if($visitor){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Request success',
                    'data' => $visitor
                ]);
            } else{
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Data not found'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.' '.$e->getMessage()
            ]);
        }
        
    }
}
