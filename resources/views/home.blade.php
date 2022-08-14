@extends('layouts.app')

@section('content')
<div class="">
    
        <div class="documentation-container">


            <div class="docs-sidebar">

                @include('layouts.sidebar')  
                
            </div>

            <div class="docs-container-content">

                <div class="docs-content-area">

                    <div class="d-flex justify-content-sm-end justify-content-between">                      

                        <div class="action-btns">
                            <a class="btn btn-primary btn-preview" href="https://designreset.com/cork-admin">Preview</a>
                            <a class="btn btn-success btn-buy-now" href="##">Buy Now</a>
                        </div>

                    </div>
                    

                    <h1 id="getting-started" class="link-heading">Getting Started<a href="#getting-started" class="link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg></a></h1>

                    
                    <hr/>
                    
                    <p class="sub-description">The CORK Admin template is a responsive web application built with <b><a href="https://getbootstrap.com/" target="_blank" class="text-secondary">Boostrap 5.x</a></b>.  It includes highly customizable UI kit, Components, Widgets, Modules, Charts and Applications for you to design interfaces and powerful web applications.</p>
                    <p class="sub-description">A glimpse of our product features are mentioned below. <a href="https://designreset.com/cork-admin" class="text-success" target="_blank">Click here</a>, to check our dashboard preview.</p>
                    
                    <h4 class="mt-5">Features:</h4>

                    <div class="features-widget">
                        
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Fully Responsive" src="./assets/images/responsive.png">
                                    </span>
                                    <div class="features-text d-inline">Fully Responsive</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Functional Dashboard" src="./assets/images/dashboard.png">
                                    </span>
                                    <div class="features-text d-inline">Functional Dashboard</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Coded with SASS" src="./assets/images/sass-blue.png">
                                    </span>
                                    <div class="features-text d-inline">Coded with SASS</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Useful Components" src="./assets/images/components.png">
                                    </span>
                                    <div class="features-text d-inline">Useful Components</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Clean Code" src="./assets/images/clean-code.png">
                                    </span>
                                    <div class="features-text d-inline">Clean Code</div>
                                </p>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Drag n Drop Section" src="./assets/images/drag.png">
                                    </span>
                                    <div class="features-text d-inline">Drag n Drop Section</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Working Apps Section" src="./assets/images/apps.png">
                                    </span>
                                    <div class="features-text d-inline">Working Apps Section</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Free Lifetime Updates" src="./assets/images/update.png">
                                    </span>
                                    <div class="features-text d-inline">Free Lifetime Updates</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Custom DataTables" src="./assets/images/datatable.png">
                                    </span>
                                    <div class="features-text d-inline">Custom DataTables</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Fast Performance" src="./assets/images/high-performance.png">
                                    </span>
                                    <div class="features-text d-inline">Fast Performance</div>
                                </p>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Built-in Tools" src="./assets/images/gulp.png">
                                    </span>
                                    <div class="features-text d-inline">Built-in Tools</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Easy to Customize" src="./assets/images/easy-to-customize.png">
                                    </span>
                                    <div class="features-text d-inline">Easy to Customize</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Dedicated Support" src="./assets/images/support.png">
                                    </span>
                                    <div class="features-text d-inline">Fast &amp; Dedicated Support</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Elegant Pages" src="./assets/images/landing-page.png">
                                    </span>
                                    <div class="features-text d-inline">Elegant Pages</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left">
                                    <span class="d-sm-inline d-block me-3">
                                        <img alt="Detailed Documentation" src="./assets/images/documentation.png">
                                    </span>
                                    <div class="features-text d-inline">Detailed Documentation</div>
                                </p>
                            </div>
                        </div>

                    </div>

                    <h4 class="mt-5">Browser Compability:</h4>

                    <div class="features-widget browser-widget">
                        
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <p class="mb-0 d-inline text-sm-left me-3">
                                    <span class="d-sm-inline d-block">
                                        <img alt="Edge" src="./assets/images/microsoft-edge.svg">
                                    </span>
                                    <div class="features-text d-inline">Edge</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left me-3">
                                    <span class="d-sm-inline d-block">
                                        <img alt="Opera" src="./assets/images/opera.svg">
                                    </span>
                                    <div class="features-text d-inline">Opera</div>
                                </p>                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <p class="mb-0 d-inline text-sm-left me-3">
                                    <span class="d-sm-inline d-block">
                                        <img alt="Safari" src="./assets/images/safari.svg">
                                    </span>
                                    <div class="features-text d-inline">Safari</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left me-3">
                                    <span class="d-sm-inline d-block">
                                        <img alt="Firefox" src="./assets/images/firefox.svg">
                                    </span>
                                    <div class="features-text d-inline">Firefox</div>
                                </p>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <p class="mb-0 d-inline text-sm-left me-3">
                                    <span class="d-sm-inline d-block">
                                        <img alt="Chrome" src="./assets/images/chrome.svg">
                                    </span>
                                    <div class="features-text d-inline">Chrome</div>
                                </p>
                                <p class="mb-0 d-inline text-sm-left me-3">
                                    <span class="d-sm-inline d-block">
                                        <img alt="Brave" src="./assets/images/brave.svg">
                                    </span>
                                    <div class="features-text d-inline">Brave</div>
                                </p>
                            </div>
                        </div>

                    </div>
                    

                    
                    <h4 class="mt-5">Overview:</h4>
                    
                    <p>There are currently 3 main folders in the top level of the directory.</p>
                    
                    <h6>1 - <i>Documentation</i></h6>
                    <p>Contains offline documention.</p>

                    <h6>2 - <i>HTML</i></h6>
                    <p>HTML folder consist of all Static HTML file with .html extension</p>
                    
                    <h6>3 - <i>Tools</i></h6>
                    <p>Contains the Task Runner - Gulp</p>
                    
                    <!-- <h6>3 - <i>Laravel</i></h6>
                        <p>Laravel folder consist of all Static HTML file with .blade.php extension</p> 
                        
                    <h6><i>Choose your best suitable framework to work with.</i></h6> -->
                        
                    <img src="./assets/images/docs-img-1.jpg" alt="docs-image-getting-started">

                    <div class="alert alert-primary" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> <span>For any support related queries just write us at <b><a href="mailto:info@designreset.com">info@designreset.com</a></b> with your purchase code.</span> 
                    </div>
                </div>
                
            </div>
            
            
        </div>

    </div>
@endsection
