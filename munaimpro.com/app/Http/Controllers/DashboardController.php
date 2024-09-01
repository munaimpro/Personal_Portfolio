<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\Models\User;
use App\Models\Message;
use App\Models\Service;
use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Models\VisitorInformations;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
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


    /* Method for admin dashboard visitor country report */

    public function dashboardVisitorCountryInfo(){
        try{
            $visitorCountry = VisitorInformations::get(['visitor_country']);

            if($visitorCountry){
                return response()->json([
                    'status' => 'success',
                    'data' => $visitorCountry
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


    /* Method for admin dashboard visitor browser usage */

    public function dashboardVisitorBrowserUsageInfo(){
        try{
            // Getting all visitor browser
            $visitors = VisitorInformations::get(['visitor_browser']);

            // Count total number of visitor
            $totalVisitor = $visitors->count();

            // Count the number of visitors for each browser
            $browserCounts = $visitors->groupBy('visitor_browser')->map->count();

            // Calculate the percentage for each browser
            $browserPercentages = $browserCounts->mapWithKeys(function ($count, $browser) use ($totalVisitor) {
                return [$browser => ($count / $totalVisitor) * 100];
            });

            if($browserPercentages){
                return response()->json([
                    'status' => 'success',
                    'labels' => $browserPercentages->keys(),
                    'percentage' => $browserPercentages->values()
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

    public function dashboardLatestVisitorInfo(){
        try{
            $latestVisitor = VisitorInformations::orderBy('last_visiting_time', 'desc')->take(1)->get(['ip_address', 'visitor_country', 'last_visiting_time']);

            if($latestVisitor){
                return response()->json([
                    'status' => 'success',
                    'data' => $latestVisitor
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

    
}
