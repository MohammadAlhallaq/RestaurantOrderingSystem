<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SwaggerAnnotations extends Controller
{
//    CUSTOMER LOGIN

    /**
     * @OA\Post(
     * path="/api/login",
     * summary=" Customer sign-in",
     * description="Login by email, password",
     * operationId="CustomerAuthLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       type="object",
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="ally.hyatt@example.org"),
     *       @OA\Property(property="password", type="string", format="password", example="password"),
     *    )
     * ),
     *
     * @OA\Response(
     *    response=201,
     *    description="Returns Customer with login token",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example= {
     *          "user":{
     *           "id": "1",
     *           "username": "Nigel Terry",
     *           "phone_number": "713-702-5801",
     *           "status_id": "1",
     *           "created_at": "2021-08-29T17:43:26.000000Z",
     *         },
     *          "token": "6|EMZRT1UKwoUMtfbqUGn1AS6IjrDAFCdJeq0KTUZm",
     *     },
     *     ),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Email and Password are required",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "message": "The given data was invalid.",
     *      "errors": {"email":"The email field is required.",
     *                  "password":"The password field is required."}
     *      }),
     *      )
     *      ),
     *
     *
     * @OA\Response(
     *    response=404,
     *    description="Wrong email or password",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example="These credentials do not match our records."),
     *    )
     * )
     * ),
     *
     */


//    *************************************************************************************************


//    CUSTOMER REGISTRATION

    /**
     * @OA\Post(
     * path="/api/sign-up",
     * summary="Customer Registration",
     * description="Customer account register",
     * operationId="CustomertReg",
     * tags={"Create Account"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass customer data",
     *    @OA\JsonContent(
     *       type="object",
     *       required={"username","email","password","password_confirmation","phone_number"},
     *       @OA\Property(property="username", type="string", format="text", example="testCustomer"),
     *       @OA\Property(property="email", type="string", format="email", example="testCustomer@gmail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="password_confirmation", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="phone_number", type="string", format="text", example="00971 55 876 3458"),
     *    )
     * ),
     *
     * @OA\Response(
     *    response=200,
     *    description="Returns login token",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example= {
     *      "access_token": "10|9jYZIV59dCRV0BiIobmaIzVemd92QTDSHgy4cRO2",
     *       "token_type": "Bearer"
     *     },
     *     ),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Required Fields",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "message": "The given data was invalid.",
     *      "errors": {"username":"The username field is required.",
     *                  "email":"The email field is required.",
     *                  "password":"The password field is required.",
     *                  "phone_number":"The phone_number field is required.",
     * }
     *      }),
     *      )
     *      ),
     *
     *
     * @OA\Response(
     *    response=404,
     *    description="Eamil or username already been taken",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "message": "The given data was invalid.",
     *      "error": {
     *     "username": "The username has already been taken",
     *     "email": "The email has already been taken."
    }
    }),
     *    )
     * )
     * )
     *
     */


//    *************************************************************************************************


    //    Restaurant LOGIN

    /**
     * @OA\Post(
     * path="/api/restaurant_login",
     * summary="Restaurant Sign-in",
     * description="Login by email, password",
     * operationId="RestaurantAuthLogin",
     * tags={"auth"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       type="object",
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="fireman@gmail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="password"),
     *    )
     * ),
     *
     * @OA\Response(
     *    response=201,
     *    description="Returns Customer with login token",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example= {
     *          "user":{
     *           "id": "1",
     *           "account_name": "Nigel Terry",
     *           "NigelTerry@gmail.com",
     *           "phone_number": "713-702-5801",
     *           "status_id": "1",
     *           "created_at": "2021-08-29T17:43:26.000000Z",
     *         },
     *          "token": "6|EMZRT1UKwoUMtfbqUGn1AS6IjrDAFCdJeq0KTUZm",
     *     },
     *     ),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Email and Password are required",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "message": "The given data was invalid.",
     *      "errors": {"email":"The email field is required.",
     *                  "password":"The password field is required."}
     *      }),
     *      )
     *      ),
     *
     *
     * @OA\Response(
     *    response=404,
     *    description="Wrong email or password",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example="These credentials do not match our records."),
     *    )
     * )
     * ),
     *
     */


//    *************************************************************************************************


//    RESTAURANT REGISTRATION

    /**
     * @OA\Post(
     * path="/api/restaurant_reg",
     * summary="Restaurant Registration",
     * description="Restaurant account register",
     * operationId="RestaurantReg",
     * tags={"Create Account"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass restaurant data",
     *    @OA\JsonContent(
     *       type="object",
     *       required={"restaurantName","email","password","password_confirmation","phone_number"},
     *       @OA\Property(property="restaurantName", type="string", format="text", example="fire man"),
     *       @OA\Property(property="email", type="string", format="email", example="fireman@gmail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="password_confirmation", type="string", format="password", example="PassWord12345"),
     *       @OA\Property(property="phone_number", type="string", format="text", example="00971 55 876 3458"),
     *    )
     * ),
     *
     * @OA\Response(
     *    response=200,
     *    description="Returns login token",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example= {
     *      "access_token": "8|u93wYup1qclBKRS3sbIKe0TnhT1nEXmTeAyxuCYA",
     *       "token_type": "Bearer"
     *     },
     *     ),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Required Fields",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "message": "The given data was invalid.",
     *      "errors": {"restaurantName":"The restaurantName field is required.",
     *                  "email":"The email field is required.",
     *                  "password":"The password field is required.",
     *                  "phone_number":"The phone_number field is required.",
     * }
     *      }),
     *      )
     *      ),
     *
     *
     * @OA\Response(
     *    response=404,
     *    description="Eamil or Restaurant name already been taken",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "message": "The given data was invalid.",
     *      "error": {
     *     "restaurantName": "The restaurant name has already been taken.",
     *     "email": "The restaurant name has already been taken."
    }
     *
    }),
     *    )
     * )
     * )
     */


//    ************************************************************************************************8


    /**
     * @OA\Post(
     * path="/api/check_email",
     * summary="Check Email",
     * description="Check if the eamil has already been taken",
     * operationId="CheckEmail",
     * tags={"check email and mobile number"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass email address",
     *    @OA\JsonContent(
     *       type="object",
     *       required={"email"},
     *       @OA\Property(property="email", type="string", format="email", example="fireman@gmail.com"),
     *    )
     * ),
     *
     * @OA\Response(
     *    response=200,
     *    description="returns email is valid",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example= {
     *      "success": "true",
     *       "message": "the email is valid"
     *     },
     *     ),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Required Fields",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "message": "The given data was invalid.",
     *      "errors": {"email":"The email field is required.",
     * }
     *      }),
     *      )
     *      ),
     *
     *
     * @OA\Response(
     *    response=404,
     *    description="Eamil has already been taken",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "message": "The given data was invalid.",
     *      "error": {
     *     "email": "The email has already been taken.",
    }
     *
    }),
     *    )
     * )
     * )
     */

//***************************************************************************************************


    /**
     * @OA\Post(
     * path="/api/check_phone_number",
     * summary="Check phone number",
     * description="Check if the phone number has already been taken",
     * operationId="CheckNumber",
     * tags={"check email and mobile number"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass phone number",
     *    @OA\JsonContent(
     *       type="object",
     *       required={"phone_number"},
     *       @OA\Property(property="phone_number", type="string", format="text", example="00971 55 876 3458"),
     *    )
     * ),
     *
     * @OA\Response(
     *    response=200,
     *    description="returns number is valid",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example= {
     *      "success": "true",
     *       "message": "the phone_number is valid"
     *     },
     *     ),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Required Fields",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "message": "The given data was invalid.",
     *      "errors": {"email":"The phone_number field is required.",
     * }
     *      }),
     *      )
     *      ),
     *
     *
     * @OA\Response(
     *    response=404,
     *    description="phone_number has already been taken",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "message": "The given data was invalid.",
     *      "error": {
     *     "phone_number": "The phone_number has already been taken.",
    }
    }),
     *    )
     * )
     * )
     */


    //    *************************************************************************************************


    /**
     * @OA\post(
     * path="/api/validate-coupon",
     * summary="Check coupon",
     * description="Check if the coupon is valid",
     * operationId="CheckCoupon",
     * tags={"Coupon"},
     * security={{ "apiAuth": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       type="object",
     *       required={"has_coupon", "coupon_value", "source_id"},
     *       @OA\Property(property="has_coupon", type="string", format="text", example="1"),
     *       @OA\Property(property="coupon_value", type="string", format="text", example="#4444"),
     *       @OA\Property(property="source_id", type="string", format="text", example="1"),
     *    )
     * ),
     *
     * @OA\Response(
     *    response=200,
     *    description="returns the valid coupon with id",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example= {
     *          "status": true,
     *          "msg": "successfully",
     *          "ret_data": {1}
     *     },
     *     ),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Required Fields",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "result": False,
     *     "message": {"The has coupon field is required.",
                        "The coupon value field is required.",
                        "The source id field is required."},
     *     "ret_data": {}
     *      }),
     *      )
     *      ),
     *
     *
     * @OA\Response(
     *    response=401,
     *    description="Coupon has already been taken",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "status": false,
     *     "msg": "This code has already been used",
     *   }),
     *    )
     * ),
     *
     * @OA\Response(
     *    response=400,
     *    description="Inactive restaurant account",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "status": false,
     *     "msg": "Restaurant account  is  inactive",
     *   }),
     *    )
     * ),
     *
     * @OA\Response(
     *    response=405,
     *    description="User account is inactive",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "status": false,
     *     "msg": "Your account is inactive",
     *   }),
     *    )
     * ),
     *  @OA\Response(
     *    response=300,
     *    description="the coupon is inactive",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "status": false,
     *     "msg": "coupon code is  inactive",
     *   }),
     *    )
     * ),
     *
     *  @OA\Response(
     *    response=301,
     *    description="check the entred code",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "status": false,
     *     "msg": "please check coupon code",
     *   }),
     *    )
     * )
     *
     * )
     *
     *
     *  /******************************************************************************************************************
     * @OA\post(
     * path="/api/get-areas",
     * summary="Get areas",
     * description="Get all the available areas",
     * operationId="GetAreas",
     * tags={"General"},
     * security={{ "apiAuth": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       type="object",
     *       required={"source_id", "city_id"},
     *       @OA\Property(property="source_id", type="string", format="text", example="1"),
     *       @OA\Property(property="city_id", type="string", format="text", example="1"),
     *    )
     * ),
     *
     * @OA\Response(
     *    response=200,
     *    description="returns all areas in the requested city",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example= {
     *          "status": true,
     *          "msg": "successfully",
     *          "ret_data": {{
                                "id": 1,
                                "area_name": "Arnous",
                                "city_id": 1,
                                "created_at": "2021-08-24 13:07:44"
    }},
     *     },
     *     ),
     *    )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Required Fields",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "result": False,
     *     "msg": {"The source id field is required.",
                        "The city id field is required.",},
     *            "ret_data": {}
     *      }),
     *      )
     *      ),
     *
     *
     *     @OA\Response(
     *    response=420,
     *    description="Invalid city id",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "result": False,
     *     "msg": {"invalid city id",},
     *            "ret_data": {}
     *      }),
     *      )
     *      ),
     *
     *
     * @OA\Response(
     *    response=401,
     *    description="Customer account is inactive",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "status": false,
     *     "msg": {"Your account is inactive",},
     *            "ret_data": {}
     *   }),
     *    )
     * ),
     * )
     *****************************************************************************************************
     *
     * * @OA\post(
     * path="/api/get-cities",
     * summary="Get cities",
     * description="Get all the available cities",
     * operationId="GetCities",
     * tags={"General"},
     * security={{ "apiAuth": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       type="object",
     *       required={"source_id", "county_id"},
     *       @OA\Property(property="source_id", type="string", format="text", example="1"),
     *       @OA\Property(property="county_id", type="string", format="text", example="1"),
     *    )
     * ),
     *
     * @OA\Response(
     *    response=200,
     *    description="returns all cities in the requested country",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example= {
     *          "status": true,
     *          "msg": "successfully",
     *          "ret_data": {{
                            "id": 1,
                            "city_name": "damascus",
                            "country_id": 1,
                            "created_at": "2021-08-24 13:07:19"
                }},
     *     },
     *     ),
     *    )
     * ),
     *
     *
     * @OA\Response(
     *    response=422,
     *    description="Required Fields",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "result": False,
     *     "msg": {"The source id field is required.",
                    "The country id field is required.",},
     *            "ret_data": {}
     *      }),
     *      )
     *      ),
     *
     *
     *     @OA\Response(
     *    response=420,
     *    description="Invalid countr id",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "result": False,
     *     "msg": {"invalid country id",},
     *            "ret_data": {}
     *      }),
     *      )
     *      ),
     *
     *
     * @OA\Response(
     *    response=401,
     *    description="Customer account is inactive",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "status": false,
     *     "msg": {"Your account is inactive",},
     *            "ret_data": {}
     *   }),
     *    )
     * ),
     * )
     *
     * *****************************************************************************************************
     *
     *
     * * * @OA\post(
     * path="/api/get-countries",
     * summary="Get countries",
     * description="Get all the available countries",
     * operationId="GetContries",
     * tags={"General"},
     * security={{ "apiAuth": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       type="object",
     *       required={"source_id", "county_id"},
     *       @OA\Property(property="source_id", type="string", format="text", example="1"),
     *    )
     * ),
     *
     * @OA\Response(
     *    response=200,
     *    description="returns all countries",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example= {
     *          "status": true,
     *          "msg": "successfully",
     *          "ret_data": {{
    "id": 1,
    "country_name": "syria",
    "created_at": "2021-08-24 13:07:05"
    }},
     *     },
     *     ),
     *    )
     * ),
     *
     *
     * @OA\Response(
     *    response=422,
     *    description="Required Fields",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "result": False,
     *     "msg": {"The source id field is required.",},
     *            "ret_data": {}
     *      }),
     *      )
     *      ),
     *
     *
     * @OA\Response(
     *    response=401,
     *    description="Customer account is inactive",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "status": false,
     *     "msg": {"Your account is inactive",},
     *            "ret_data": {}
     *   }),
     *    )
     * ),
     * )
     *
     * ****************************************************************************************************
     *
     *  *
     *
     * * * @OA\post(
     * path="/api/get-items",
     * summary="Get items",
     * description="Get all item of the requested restaurant",
     * operationId="GetItems",
     * tags={"Items"},
     * security={{ "apiAuth": {} }},
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       type="object",
     *       required={"source_id", "restaurant_id"},
     *       @OA\Property(property="source_id", type="string", format="text", example="1"),
     *       @OA\Property(property="restaurant_id", type="string", format="text", example="1"),
     *    )
     * ),
     *
     * @OA\Response(
     *    response=200,
     *    description="returns all countries",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example= {
     *          "status": true,
     *          "msg": "successfully",
     *          "ret_data": {{
    "id": 1,
    "country_name": "syria",
    "created_at": "2021-08-24 13:07:05"
    }},
     *     },
     *     ),
     *    )
     * ),
     *
     *
     * @OA\Response(
     *    response=422,
     *    description="Required Fields",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "result": False,
     *     "msg": {"The source id field is required.",
     *              "The restaurant id field is required."},
     *            "ret_data": {}
     *      }),
     *      )
     *      ),
     *
     *
     * @OA\Response(
     *    response=401,
     *    description="Customer account is inactive",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "status": false,
     *     "msg": {"Your account is inactive",},
     *            "ret_data": {}
     *   }),
     *    )
     * ),
     * ),
     *
     * @OA\Response(
     *    response=407,
     *    description="Restaurant is inactive",
     *    @OA\JsonContent(
     *       @OA\Property(property="result", type="object", example={
     *     "status": false,
     *     "msg": {"Restaurant account  is  inactive",},
     *            "ret_data": {}
     *   }),
     *    )
     * ),
     * )
     *
     *
     *
     *
     *
     *
     *
     *
     *
     */


}
