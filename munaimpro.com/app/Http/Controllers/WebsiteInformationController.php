<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Logo;
use App\Models\Post;
use App\Models\User;
use App\Models\Message;
use App\Models\Service;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\Seoproperty;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\VisitorInformations;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class WebsiteInformationController extends Controller
{
    /* Method for admin dashboard page */

    public function adminDashboardPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.dashboard', compact(['routeName']));
    }


    /* Method for admin dashboard statistics */

    public function dashboardStatInfo(){
        try{
            // Total user
            $total_user = User::all()->count();
            // Total portfolio
            $total_portfolio = Portfolio::all()->count();
            // Total service
            $total_service = Service::all()->count();
            // Total category
            $total_category = Category::all()->count();
            // Total post
            $total_post = Post::all()->count();
            // Total visitor
            $total_visitor = VisitorInformations::all()->count();
            // Total new message
            $total_message = Message::where('message_status', 'new')->get()->count();

            return response()->json([
                'status' => 'success',
                'total_user' => $total_user,
                'total_portfolio' => $total_portfolio,
                'total_service' => $total_service,
                'total_category' => $total_category,
                'total_post' => $total_post,
                'total_visitor' => $total_visitor,
                'total_message' => $total_message,
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'.' '.$e->getMessage()
            ]);
        }
    }


    /* Method for admin dashboard latest project */

    public function dashboardLatestProjectInfo(){
        try{
            $latestProject = Portfolio::latest()->take(3)->get(['project_title', 'project_thumbnail', 'project_status']);

            if($latestProject){
                return response()->json([
                    'status' => 'success',
                    'data' => $latestProject
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
                'message' => 'Something went wrong'.' '.$e->getMessage()
            ]);
        }
    }


    /* Method for admin dashboard latest post */

    public function dashboardLatestPostInfo(){
        try{
            $latestPost = Post::latest()->take(3)->get(['post_heading', 'post_thumbnail', 'post_status']);

            if($latestPost){
                return response()->json([
                    'status' => 'success',
                    'data' => $latestPost
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
                'message' => 'Something went wrong'.' '.$e->getMessage()
            ]);
        }
    }


    /* Method for admin dashboard latest user */

    public function dashboardLatestUserInfo(){
        try{
            $latestUser = User::latest()->take(3)->get(['first_name', 'last_name', 'profile_picture', 'role']);

            if($latestUser){
                return response()->json([
                    'status' => 'success',
                    'data' => $latestUser
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
                'message' => 'Something went wrong'.' '.$e->getMessage()
            ]);
        }
    }


    /* Method for admin dashboard new message */

    public function dashboardNewMessageInfo(){
        try{
            $newMessage = Message::where('message_status', 'new')->latest()->get(['id', 'name', 'email', 'subject', 'message']);

            if($newMessage){
                return response()->json([
                    'status' => 'success',
                    'data' => $newMessage
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
                'message' => 'Something went wrong'.' '.$e->getMessage()
            ]);
        }
    }


    /* Method for admin logo & seo property page */

    public function adminLogoWithSEOPropertyPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.seoproperty', compact(['routeName']));
    }


    /* Method for retrieve logo */
    
    public function retrieveLogoInfo(){
        try{
            // Get the first row from the logo table
            $logo = Logo::first();
            
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
            // Input validation process for backend
            $validatedData = $request->validate([
                'logo' => 'required|image|mimes:png,jpg,jpeg',
            ]);

            $logo = Logo::first();

            if($request->hasFile('logo')){
                // Retrive previous logo link from database
                $getPreviousLogoImage = Logo::where('id', '=', $logo->id)->first('logo');

                // Remove logo file from storage
                if($getPreviousLogoImage){
                    if(Storage::exists("public/website_logo/".$getPreviousLogoImage->logo)){
                        Storage::delete("public/website_logo/".$getPreviousLogoImage->logo);
                    }
                }

                // Getting new file
                $logoImage = $request->file('logo');

                // Extract the original file name with extension
                $logoName = $logoImage->getClientOriginalName();

                // Assign logo name to validated data
                $validatedData['logo'] = $logoName;
                
                $logoUpdate = $logo->update($validatedData);

                // Store logo image into storage/public/website_logo folder
                if ($logoUpdate){
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
    
    public function retreiveAllSeoPropertyInfo(){
        try{
            $seoproperty = Seoproperty::get(['id', 'page_name', 'site_title', 'site_keywords', 'site_description']);
            
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

    public function retrieveSeoPropertyInfoById(Request $request){
        try{
            $seopropertyInfoId = $request->input('seoproperty_info_id'); // Primary key id from input
        
            $seoproperty = Seoproperty::findOrFail($seopropertyInfoId, ['page_name', 'site_title', 'site_keywords', 'site_description', 'author', 'og_site_name', 'og_url', 'og_title', 'og_description', 'og_type', 'og_image', 'twitter_card', 'twitter_title', 'twitter_description', 'twitter_image', 'robots', 'canonical_url', 'application_name', 'theme_color', 'google_site_verification', 'referrer']); // Getting SEO property data by id

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
                'site_title' => 'required|string|max:50',
                'site_keywords' => 'required|string',
                'site_description' => 'required|string|max:255',
                'author' => 'required|string|max:100',
                'og_site_name' => 'required|string|max:100',
                'og_url' => 'required|string|max:100',
                'og_title' => 'required|string|max:100',
                'og_type' => [
                    'required',
                    Rule::in(['website', 'article', 'video.movie', 'video.episode', 'video.tv_show', 'video.other', 'music.song', 'music.album', 'profile', 'product'])
                ],
                'og_description' => 'required|string|max:255',
                'twitter_card' => [
                    'required',
                    Rule::in(['summary', 'summary_large_image', 'app', 'player'])
                ],
                'twitter_title' => 'required|string|max:100',
                'twitter_description' => 'required|string|max:255',
                'robots' => [
                    'required',
                    Rule::in([
                        'index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow',
                        'noarchive', 'nosnippet', 'noodp', 'noimageindex', 'nocache'
                    ])
                ],
                'canonical_url' => 'required|string|max:100',
                'application_name' => 'required|string|max:100',
                'theme_color' => 'required|string|max:100',
                'google_site_verification' => 'nullable|string|max:100',
                'referrer' => [
                    'required',
                    Rule::in([
                        'no-referrer', 'no-referrer-when-downgrade', 'origin', 'origin-when-cross-origin',
                        'same-origin', 'strict-origin', 'strict-origin-when-cross-origin', 'unsafe-url'
                        ])
                    ],
                'seoproperty_info_id' => '',
            ]);
    
            // Retrieve SEO property instance only once
            $seoproperty = Seoproperty::findOrFail($validatedData['seoproperty_info_id']);

            // Handle Open Graph image
            if($request->hasFile('og_image')){
                // Validate Open Graph image
                $request->validate(['og_image' => 'required|image|mimes:png,jpg,jpeg|max:2048']);

                // Remove Open Graph image file from storage
                if($seoproperty->og_image && Storage::exists("public/website_pictures/website_social_images/".$seoproperty->og_image)) {
                    Storage::delete("public/website_pictures/website_social_images/".$seoproperty->og_image);
                }
    
                // Store new OG image
                $ogImage = $request->file('og_image');
                $ogImageName = substr(md5(time()), 0, 5) . '-' . $ogImage->getClientOriginalName();
                $ogImage->storeAs('website_pictures/website_social_images', $ogImageName, 'public');
                $validatedData['og_image'] = $ogImageName;

            }

            // Handle Twitter image
            if($request->hasFile('twitter_image')){
                // Validate Twitter image
                $request->validate(['twitter_image' => 'required|image|mimes:png,jpg,jpeg|max:2048']);

                // Remove Twitter image file from storage
                if($seoproperty->twitter_image && Storage::exists("public/website_pictures/website_social_images/".$seoproperty->twitter_image)) {
                    Storage::delete("public/website_pictures/website_social_images/".$seoproperty->twitter_image);
                }
    
                // Store new Twitter image
                $twitterImage = $request->file('twitter_image');
                $twitterImageName = substr(md5(time()), 0, 5) . '-' . $twitterImage->getClientOriginalName();
                $twitterImage->storeAs('website_pictures/website_social_images', $twitterImageName, 'public');
                $validatedData['twitter_image'] = $twitterImageName;

            }
    
            // Update SEO property with validated data
            $seoproperty->update($validatedData);
        
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


    /* Method for delete SEO property information */

    public function deleteSeoPropertyInfo(Request $request){
        // Start transaction
        DB::beginTransaction();
    
        try{
            // Getting SEO property id from input
            $seopropertyInfoId = $request->input('seoproperty_info_id');
    
            // Retrieve SEO property from the database
            $seoproperty = Seoproperty::findOrFail($seopropertyInfoId);
    
            // Retrieve and delete the Open Graph image
            $ogImage = $seoproperty->og_image;

            if($ogImage && Storage::exists("public/website_pictures/website_social_images/" . $ogImage)){
                if (!Storage::delete("public/website_pictures/website_social_images/" . $ogImage)){
                    // Rollback the transaction
                    DB::rollBack();

                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Failed to delete Open Graph image'
                    ]);
                }
            }
    
            // Retrieve and delete the Twitter image
            $twiterImage = $seoproperty->twitter_image;

            if($twiterImage && Storage::exists("public/website_pictures/website_social_images/" . $twiterImage)){
                if (!Storage::delete("public/website_pictures/website_social_images/" . $twiterImage)){
                    // Rollback the transaction
                    DB::rollBack();

                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Failed to delete Twitter image'
                    ]);
                }
            }
    
            // Delete SEO data by id
            if (!$seoproperty->delete()){
                DB::rollBack();

                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to delete portfolio'
                ]);
            }

            // Commit the transaction
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'SEO Property deleted'
            ]);
    
        } catch (Exception $e){
            // Rollback the transaction
            DB::rollBack();

            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }


    /* Method for admin visitor information page */

    public function adminVisitorInformationPage(){
        // Getting view name from uri
        $routeName = last(explode('/', Route::getCurrentRoute()->uri));

        return view('admin.pages.visitorinfo', compact(['routeName']));
    }


    /* Method for retrieve website visitor information */
    
    public function retrieveAllVisitorInfo(){
        try{
            $visitor = VisitorInformations::get(['id', 'ip_address', 'visitor_country', 'visitor_browser', 'total_visit', 'last_visiting_time']);
            
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


    /* Method for retrieve website visitor information by id */
    
    public function retrieveVisitorInfoById(Request $request){
        try{
            $visitorInfoId = $request->input('visitor_info_id'); // Primary key id from input
        
            $visitor = VisitorInformations::findOrFail($visitorInfoId, ['ip_address', 'visitor_country', 'visitor_browser', 'total_visit', 'last_visiting_time']); // Getting visitor data by id
            
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
