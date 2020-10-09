# americas-farmers-integrity
Rebuild of the Americas Farmers site for Monsanto

## Team
- Dev Lead: Julia Cramer
- Dev Support: Jordan Fautley
- Dev Support: Laura Kong
- Dev Support: Drew Newman
- PM: Jamal Mclaughlin

## Links
- Prod Site: [https://www.americasfarmers.com/](https://www.americasfarmers.com/)
- WP Engine Stage: [https://amerfarmersdev.wpengine.com/](https://amerfarmersdev.wpengine.com/)

## Overview

This site was originally developed by Paradowski. However we are taking over and rebuilding the theme such that it is less brittle and easier to maintain. The site itself houses 3 charity programs which are on a rotating schedule, moving between Enroll, Announce, and Story phases. These programs push and pull data from SalesForce via a CastIron/Datapower API that sits on top of Monsanto's Salesforce. We will be working with that API to allow users to register for the various charity events, as well as to view winners of those events to see who was rewarded funds, and when those awards ceremonies will take place.

## Setup

Set up is fairly basic. Just pull the repo, run `npm install`, run gulp (which will watch and compile js/scss), set up a db and MAMP host and you're good to go.

## Flexible Content
We're developing the site in a component structure and will be using ACF's Flexible content fields to plug these into pages. This means that when working on a component, you'll need to build it out as an appropriate ACF flexible content template, as well as wire up the fields into the Flex Content Template.

You can use the "custom fields" GUI to build out your fields, but you'll need to export them as PHP code so that they are checked into src.

The ACF code goes in `theme_infrastructure/ACF/ACFTemplateFields.php` There is already a block in there for the flex content template. You'll just be adding new fields inside the layouts section of that block. This means that you can build your fields in the GUI, then just export the code and paste it in as another array in the layouts section there.

The templates (or views) of the components will go in `template-parts/flex-content` All templates need to be prefixed with 'content-' and then named whatever the name is for the layout, then `.php`. For example, full_width_content is the layout name for my example one. That means the template is named `content-full_width_content.php`

This way the flex content template will automatically pull int he partials it needs.

When building a partial, please include a comment at the top of the file indicating what it is and listing our relevant ACF fields. This will make it easier to stick that onto another page.

### Programs
Programs is a custom post type used to represent the three programs currently running. These house the phase start/end times and can be referenced in other objects to relate them to that program.

#### Import GrowAgLeaders Winners
**This site is using plugin WP All Import Pro to add/import Winners instead of Salesforce API**

**The columns name in the CSV file should be like this:**

- Year
- Student First Name
- Student Last Name
- City
- State
- Major Description
- FFA Chapter Name

**Import Steps:**

1. Remove all old Winners first.
1. Click All Import on WP admin.
1. Click Upload a file, choose file you want to upload.
1. Choose `Grow Ag Leaders Winners` as Import destination, click Continue to Step 2.
1. Click Continue to Step 3.
1. Choose `Ag Leaders Winners Template` on Save settings as a template, click Continue to Step 4.
1. Click Continue, then click Confirm & Run Import.

#### Program Helper Functions

**getProgramPhase($id)**
This function will return a string indicating which phase the program is in.
The valid phases are:

- `enroll` - Open for sign up
- `announce` - Winners have been selected and announced
- `story` - Catch all for when the other two phases are not appropriate

### Setting UP the Salesforce Config
Inside Theme Config in WP Admin you will find a Salesforce API Config section.

1. Grab the test client secret from team password and put it in here.
1. Set the Client ID to "Americas-Farmers" and click the "test" radio button.
1. From that point on your Salesforce Modules will hit the test API.

### Monsanto API
Monsanto has written it's own API implementation on top of Salesforce. This is built in Cast Iron and Data Power.

We have tried to get documentation on this but the Monsanto team seems unable to provide it, so I've begun documenting below what I can from reverse engineering the Paradowski implementation.

#### Postman
The easiest way to test these API calls outside of WP is to use [Postman](https://www.getpostman.com/). 
We have a collection of these API calls saved in the [Intergrity Postman Team account](https://integrity.postman.co/workspaces/a70a9b7d-0592-4f89-8323-9209a050e781/collections). 
You'll need a Postman account and to be invited to the Team in order to access them. Postman is also used to 
screenshot when we have errors to pass that information along to Monsanto's API team.

There's also a sample export from Postman in the theme in `/js/libs`.

#### Our Implementation
Fields for the relevant credentials live under theme config -> salesforce config

The actual methods to call live in `/theme_infrastructure/SalesforceAPICalls`

These can be called with relevant params passed and they should return a PHP object containing the result.

### Endpoint Details

#### Authorization
- **Production** `https://amp.monsanto.com/as/token.oauth2?grant_type=client_credentials`
- **TEST** `https://test.amp.monsanto.com/as/token.oauth2?grant_type=client_credentials`

Accepts client_id and client_secret passed as x-www-form-urlencoded data.
Returns JSON
```
{
    'access_token': "xxx",
    'token_type': "Bearer",
    "expires_in": xxx
}
```

The token that is returned is used in every subsequent request in the Authorization header as a bearer token

`Authorization: Bearer xxxxx`

The Client ID and secret are in Team Password.

#### Winners
- **Production** `https://mongateway.monsanto.com:443/AmericasFarmersWinnerUpdate`
- **Test** `https://mongateway-t.monsanto.com:443/AmericasFarmersWinnerUpdate`

Returns an array of serialized JSON containing winners data.

Accepts the following parameters as HEADERS

**Test endpoint will sometimes error. It used to 404 frequently, but is more consistent now**

1. category: GrowRuralEducation or GrowCommunities.
    *  *GrowAgLeaders is setup differently and is currently being added to the API by the Salesforce API Team.*
2. year: Just the year of winners. 
    * ***Note*** `GrowCommunities` and `GrowAGLeaders` have their Programs lapse into 2 separate years. SalesForce goes based on the year that the data started. This means calling data that's announced in 2019 ***needs to be called with the year 2018.***
3. state:  State abbrev eg: WI

#### Nomination Checker

- **Production** `https://mongateway.monsanto.com/GREnominationCount`
- **Test** `https://mongateway-t.monsanto.com/GREnominationCount `

**Test endpoint currently returns 404**
This endpoint seems to do 2 completely different things. Passing the following parameters as headers returns a list of schools with ID and other data.

- 'content-type': 'application/json'
- 'state': 'WI'

If you pass a `schoolid` instead of a state, you get either a nomination count or record not found if not nominated

`a9F3A0000004ZgRUAU` is a working school ID for Baldwin County School District in Baldwin County Alabama

#### Enrollment
- **Prod Americas Farmers Communities**  `https://mongateway.monsanto.com:443/AmericasFarmersEnrollment`
- **Prod Rural Education** `https://mongateway.monsanto.com:443/AmericasFarmersGRE`

- **Test Americas Farmers Communities**  `https://mongateway-t.monsanto.com:443/AmericasFarmersEnrollment`
- **Test Rural Education** `https://mongateway-t.monsanto.com:443/AmericasFarmersGRE`

**Americas Farmers Example Request**
```
{
"ErrorDetails": "",
"RequestStatus": "",
"Agrees_to_Official_Rules": true,
"city": "Saint Louis",
"County_ID": "STL",
"County_Name": "Rest Request1",
"Email": "my.test@gmail.com",
"Facebook_Username": "Lindbergh1",
"First_Name": "Saint Louis1",
"Is_21_or_older": true,
"Is_Spouse_Seed_Dealer": true,
"Last_Name": "Tester123",
"Organization_Name": "Org Name",
"Organization_Type": "Seeddealer",
"Organization_Type_Id": "SD",
"Phone": "8787678689",
"Prefix": "Mr.",
"State": "MO",
"Status": "Active",
"Street_1": "Lindbergh",
"Street_2": "Creve Coeur",
"Twitter_Username": "testaccount1",
"Uses_Social_Media": true,
"Zip_Postal_Code": "63167"
}
```

**Rural Enrollment Example Request**
```
{
 "Is_Seed_Dealer": true,
 "State": "MO",
"County_ID": "STfdfdL",
 "County_Name": "Saint Louis",
"Prefix": "STL",
"First_Name": "Rest Request4",
"Last_Name": "Rest Response4",
"Street_1": "Creve Coeur",
"Street_2": "Lindbergh",
"city": "Saint Louis",
"Zip_Postal_Code": "63167",
"Phone": "2536974124",
"Cell_Phone": "2536974124",
"Email": "my.test@gmail.com",
"Agrees_to_Official_Rules": true,
"Is_21_or_older": true,
 "Eligible_School_District_County": "STL",
"NCES_ID": "78687",
"School_District": "School",
"ErrorDetails": ""
}
```
It seems like you can add `?EnrollmentCode=` to query for an enrollment code but beyond that, I'm not sure.

##### Enrollment by Code
Users will receive an email asking them to sign up. This will contain a link with `?enrollmentCode=xxxxxx`

We will read that and immediately hit the SF api.

This hits the same enrollment endpoints for the respective program, but is a GET request with the param `?EnrollmentCode=xxxxx`

This will return a user in the following format

```
{
    "Zip_Postal_Code": "56097",
    "Uses_Social_Media": false,
    "Twitter_Username": null,
    "Street_2": null,
    "Street_1": "12625 STATE HIGHWAY 22",
    "Status": null,
    "State": "MN",
    "RequestStatus": "Record Found",
    "Prefix": null,
    "Phone": null,
    "Organization_Type_Id": null,
    "Organization_Type": null,
    "Organization_Name": null,
    "Last_Name": "WEGNER",
    "Is_Spouse_Seed_Dealer": false,
    "Is_21_or_older": false,
    "First_Name": "ERIC",
    "Facebook_Username": null,
    "ErrorDetails": null,
    "Enroll_Time": null,
    "Email": null,
    "County_Name": "FARIBAULT",
    "County_ID": null,
    "city": "WELLS",
    "Agrees_to_Official_Rules": false
}
```

We will then pre-fill the normal enrollment form with this data, and let them self-correct it and submit the final form.

Here are some test enrollment codes:

2017 Grow Rural Education
AFI-113909  
AFI-124776  
AFI-114360  
AFI-124777  
AFI-114741  
2017 Grow Communities
AFI-8274    
AFI-8319    
AFI-8335    
AFI-8942    
AFI-8943

#### Enrollment Cache

Because the API is so inconsistent, we set up a separate MySQL table to save Enrollment attempts.
This saves every Enrollment attempt to our DB. It uses DBDelta, [which is a WP Database
function](https://developer.wordpress.org/reference/functions/dbdelta/). There's an Admin page that just echos the count, so
nothing fancy is happening there.

1. When an enrollment occurs, this entry saves to the DB to a table for that program.
1. It then tries to submit to SalesForce.
1. **If the submission worked** that entry in the DB is marked as submitted.
1. **If the submission failed** that entry is marked as not submitting.

To view a count of Success/Failed enrollment attempts, sign into the WP Admin and view the `Enrollment Submissions` page.

There's separate tables depending on the Program that's accepting enrollments. `wp_grow_communities` is for Grow Communities
and `wp_rural_ed` is for Grow Rural Education. If the client asks for a copy of this information:

1. Go to phpMyAdmin for the live site (sign into WP Engine Dashboard > monsanto install > americasfarmers site > phpMyAdmin).
1. Find the table in the DB and click into it to view.
1. Choose Export.
1. In the export settings, choose to save it as `CSV` then export that bugger.

#### Postman Monitoring

To help with the inconsistent API, we've set up Postman Monitoring to provide history and alerts when the API returns errors.

- It's currently scheduled to run every day at midnight.
- It hits every Prod endpoint we use and checks for a response code of 200.
- For the submission endpoint, we intentionally pass incomplete data so test entries aren't created each time. This should still return a 200 error code based on how they've set things up.

To edit / view this monitoring, you'll need to be added to the Integrity Postman account. Once logged in:

1. Go to the Integrity workspace
1. Click on the *Monitor* link, then `America's Farmers API Monitor`
1. To edit settings or to add an email to alert, click the wee `...` icon, then click "Edit". Currently, Aaron and Lindsay are set to get these emails.

#### Get Enrollment Data From WP DB

Sometimes we cannot get enrollment data from API so we may need to get data from DB dircetly.

- Go to WP Engine -> PhpMyAdmin and export table named `wp_programname_emrollment`



