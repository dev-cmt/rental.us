<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactSubmission;
use App\Models\Testimonial;
use App\Models\Property;
use App\Models\Contact;
use App\Models\Country;
use App\Models\State;
use App\Models\PaymentMethod;
use App\Models\Application;
use App\Models\Achievement;
use App\Models\Service;
use App\Models\Category;
use App\Models\HeroBanner;
use App\Models\ApplicationSuccess;
use App\Helpers\ImageHelper;

class HomeController extends Controller
{
    public function welcome()
    {
        $heroBanner = HeroBanner::getActive();
        $categories = Category::where('status', 'active')->withCount('properties')->get();
        $rentProperties = Property::with('category', 'images')->where('status', 'active')->latest()->take(6)->get(); // ->where('property_status', 'For Rent')
        $saleProperties = Property::with('category', 'images')->where('status', 'active')->latest()->take(4)->get(); // ->where('property_status', 'For Sale')
        $testimonials = Testimonial::where('status', 'active')->latest()->take(10)->get();
        $achievements = Achievement::where('status', 'active')->orderBy('sort_order')->get();
        $services = Service::where('status', 'active')->orderBy('sort_order')->get();

        return view('frontEnd.welcome', compact('heroBanner', 'categories', 'achievements', 'services','testimonials', 'rentProperties', 'saleProperties'));
    }
    /**________________________________________________________________________________________
     * About Menu Pages
     * ________________________________________________________________________________________
     */
    public function about()
    {
        return view('frontEnd.pages.about-us');
    }
    /**________________________________________________________________________________________
     * About Menu Pages
     * ________________________________________________________________________________________
     */
    public function properties(Request $request)
    {
        $query = Property::query();

        // Filter by type
        if ($request->typeprt) {
            if ($request->typeprt == 'buy') {
                $query->where('property_status', 'For Sale');
            } elseif ($request->typeprt == 'rent') {
                $query->where('property_status', 'For Rent');
            }
        }

        // Filter by location (city, state, country)
        if ($request->location) {
            $location = $request->location;
            $query->where(function ($q) use ($location) {
                $q->where('city', 'like', "%$location%")
                  ->orWhere('state_county', 'like', "%$location%")
                  ->orWhere('country', 'like', "%$location%")
                  ->orWhere('address', 'like', "%$location%");
            });
        }

        // ✅ Filter by category
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $properties = $query->latest()->paginate(10)->withQueryString();

        return view('frontEnd.pages.properties', compact('properties'));
    }

    public function propertyDetails($slug)
    {
        $property = Property::with('images')
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        // Increment view count
        $property->increment('view_count');

        return view('frontEnd.pages.property-details', compact('property'));
    }

     /**________________________________________________________________________________________
     * About Menu Pages
     * ________________________________________________________________________________________
     */
    public function contact()
    {
        $contactInfo = Contact::first();
        return view('frontEnd.pages.contact-us', compact('contactInfo'));
    }

    public function contactStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        ContactSubmission::create($request->all());

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

     /**________________________________________________________________________________________
     * About Menu Pages
     * ________________________________________________________________________________________
     */
    public function applicationFrom()
    {
        $states = State::all();
        $countries = Country::all();
        $paymentMethods = PaymentMethod::where('status', 1)->get();

        return view('frontEnd.pages.application-from', compact('countries', 'states', 'paymentMethods'));
    }

    public function applicationSubmit(Request $request)
    {
        $data = $request->only([
            'move_in_date','application_type','full_name','email','phone',
            'current_address','city','state','zip_code','country','citizenship',
            'date_of_birth','monthly_income','government_id','issuing_state','ssn'
        ]);
        // Handle file uploads
        $files = ['id_front_path','id_back_path','selfie_path','income_path','payment_path'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $data[$file] = ImageHelper::uploadImage($request->file($file), 'uploads/applications');
            }
        }
        $data['status'] = 'pending';
        Application::create($data);

        return redirect()->back()->with('success', 'Rental application submitted successfully!');
    }
    public function applicationSuccess()
    {
        $applicationSuccess = ApplicationSuccess::first();
        return view('frontEnd.pages.application-success', compact('applicationSuccess'));
    }

}
