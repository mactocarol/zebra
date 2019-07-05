USERS : 
userId,
firstName,
lastName,
userProfile,
email,
password,
businessName,
businessType, (Busness,Individual)
//location,
mobileNumber,
userType, (Customer,Driver)
vehicleType,
homeAddress,
latitude,
longitude,
deliverAlcohol, (Yes,No)
deviceType,(Ios,Android)
deviceToken,
isVerify,(Yes,No)
onlineStatus,
authToken,
availability,(Yes,No)
status, (Active,Inactive)
crd,
upd,


ORDER : 
orderId,
orderToken,

itemQuantity,
itemDescription,
vehicleType, //(Car,Motorbike,Van)
deliveryOption, // (1hour,2hour,3hour,sameDay)


pickupAddress,
pickupLatitude,
pickupLongitude,
pickupLandmark,
pickupInstructions,
pickupDate,
pickupTime,
senderName,
senderNumber,

deliveryAddress,
deliveryLatitude,
deliveryLongitude,
deliveryLandmark,
deliveryInstructions,
receiverName,
receiverNumber,

sendMsg, // (Yes,No) send tracking SMS
checkRecipientId, // (Yes,No) check recipiant id card
alcoholDelivery, // (Yes,No) item is alcohol or not
leaveUnattended,// (Yes,No) // if receiver not available then item give other 
fragileItem,// (Yes,No) // is item is brekeble fragile(नाज़ुक)

otherInstructions,
referenceId