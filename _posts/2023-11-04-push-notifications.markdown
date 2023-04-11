---
layout: post
title: "Sending push notifications to mobile using Expo working example"
date:   2023-04-11 10:58:41 +0400
categories: blog
---

For more theory, you can use
this [expo's push api](https://docs.expo.dev/push-notifications/sending-notifications/) doc.

I will show you my working example.
I will use Python.

### 1 Install exponent-server-sdk-python

{% highlight Shell %}
pip install exponent_server_sdk
{% endhighlight %}

### 2 Get your Expo Access token
Go to  Expo's dev account page. Then go to the https://expo.dev/accounts/{your_company}/settings/access-tokens/ and create a new token. Copy it.

It should look like this:
![expo-access.png](/img/blog/expo-access.png)

next, we need to use that token in our code.

### 3 Write function to send notification

{% highlight Python %}

    import requests
    from exponent_server_sdk import (
    PushClient,
    PushMessage,
    )


    session = requests.Session()
    session.headers.update(
        {
        "Authorization": "Bearer {your_access_token}",
        "accept": "application/json",
        "accept-encoding": "gzip, deflate",
        "content-type": "application/json",
        }
    )

    def send_push_message(
        token,
        message,
        notif,
        extra=None,
        ):
        response = PushClient(session=session).publish(
            PushMessage(
                to=token,
                body=message,
                title="ORBI",
                data=extra,
                sound="default",
            )
        )
        if response.status == "ok":
            print("push message sent")
            notif.pushed = 1
            notif.save()

{% endhighlight %}

Each device has a token, which looks like this: ExponentPushToken[xxxxxxxxxxxxxxxxxxxxxx]. 
this token is first parameter of the function.

### 4 GET device ExponentPushToken 

{% highlight Javascript %}

    async function registerForPushNotificationsAsync() {
        let token;
        if (Device.isDevice) {
            const { status: existingStatus } = await Notifications.getPermissionsAsync();
            let finalStatus = existingStatus;
            if (existingStatus !== 'granted') {
                const { status } = await Notifications.requestPermissionsAsync();
                finalStatus = status;
            }
            if (finalStatus !== 'granted') {
                alert('Failed to get push token for push notification!');
                return;
            }
            token = (await Notifications.getExpoPushTokenAsync()).data;
            console.log(token);
        } else {
            alert('Must use physical device for Push Notifications');
        }

        if (Platform.OS === 'android') {
            Notifications.setNotificationChannelAsync('default', {
                name: 'default',
                importance: Notifications.AndroidImportance.MAX,
                vibrationPattern: [0, 250, 250, 250],
                lightColor: '#FF231F7C',
            });
        }

        return token;
        }

{% endhighlight %}

this function is from expo's documentation. it allows you to register device and the ExponentPushToken[xxxxxxxxxxxxxxxxxxxxxx]. 

### 5 Send the notification

{% highlight Python %}

    for notif in notifications:
        customer = notif.customer
        devices = CustomerDevice.objects.filter(
            customer=customer, push_token__isnull=False
        )
        for device in devices:
            expo_token = f"ExponentPushToken[{device.push_token}]"
            send_push_message(expo_token, notif.msg_en, notif)

{% endhighlight %}

this is the result in my case.
![push-notif.png](/img/blog/push-notif.png)


### 6 Important Tip
While you are using Expo go to look at your notifications. App Icon and App Name will be Expo go.
when you publish your app, you will see your app name and icon.


### 7 Conclusion
As you can see, it is not so hard to send push notifications to mobile using Expo.

I hope this article was helpful to you.





