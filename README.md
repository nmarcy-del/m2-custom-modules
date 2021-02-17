# m2-custom-modules
variety of my magento 2 custom modules for my futur use in several projet or four our disposal.
 
 - Del01TrackingUrl : 
 
 TrackingUrl : Module write to get current store active carriers.
    Use url : http://[base_url]/activecarriers/show/carriers on frontend to get json object.
    Format is : [carrierCode_methodCode => '[carrierCode] methodTitle']
    
 EmailTracking : Futur feature
 
 - Del01CarrierList : 
 
 RapidCarrierList : This module allow to display on tracking popup each native tracking link. 
 You can add new tracking link on backoffice with system.xml and then add url where {{number}} was track number send by magento.
 Core config in backoffice can be find on Store => Configurations => Sales => TrackingsSettings
 
 -Del01Promotion :
 
  DailyTimedPromotion : Add start and end time condition for promotion. If start and end time as set the rule validator check current time before
    applying sales rule only if your order is made on correct range.
  
  Popup : Done => create popup with editor, select prewrite template, set display area and limit.
    To do : set time range limit to display (in js file if true condition)
    
   
