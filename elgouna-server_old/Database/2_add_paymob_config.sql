ALTER TABLE booking_link ADD column paymobAPIKey  varchar(800);

ALTER TABLE booking_link ADD column paymobSecretKey  varchar(800);

ALTER TABLE booking_link ADD column paymobMerchantId  varchar(800);

ALTER TABLE booking_link ADD column paymobSecureHash  varchar(800);

update booking_link set paymobMerchantId = "128SS50539TYPESNVNA7CW8" ,paymobSecretKey="TITLB7N5TJJTIV0FQPU24HL65" ,paymobAPIKey="GOUNA_0MBO-Y84Z7ZKI2SDFVK4", paymobSecureHash="YIKYVEKCM9U369KLODJ2QMRPX"  where id =1;
