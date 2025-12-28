
# 📦 Notifier Module

The `Notifier` module is a multi-channel notification system capable of sending messages through the following channels:

* SMS
* Email
* Push Notifications
* Database Storage

This module is built with a **scalable, multi-channel, and async job-based architecture**.

---

## 📁 Module Structure

### `app/Models/`

* `Notification` – General notification information
* `Provider` – Notification service providers (e.g., Kavenegar, FCM, SMTP)
* `DatabaseNotification` – Stored notifications for users

---

### `app/Enums/`

* `EnumNotificationStatus` – Notification statuses (pending, sent, failed, etc.)
* `EnumProviderType` – Types of providers (SMS, Email, etc.)
* `EnumStorageNotificationType` – Categories for stored notifications

---

### `app/Http/Requests/`

Request classes for sending notifications via:

* SMS: `SmsSendRequest`, `SmsSendPatternRequest`
* Email: `MailSendRequest`
* Push: `PushSendAllRequest`
* Storage: `StorageSaveRequest`

---

### `app/Http/Procedures/`

Service entry points for each channel:

* `SmsProcedure.php`, `MailProcedure.php`
* `PushProcedure.php`, `StorageProcedure.php`

---

### `app/Channels/`

Channel implementations:

#### SMS

Sends plain or pattern-based SMS messages via providers like Kavenegar and SMS.ir.

#### E-mail

Sends emails via SMTP or other extensible methods.

#### Push

Sends push notifications (e.g., via FCM) to mobile apps or web browsers.

#### Storage

Stores notifications in the database for later viewing or reporting purposes.

---

### `app/Jobs/Drivers/`

Jobs that are responsible for the actual delivery of notifications, organized by provider:

* `Sms/Kavenegar`, `Sms/SmsIr`
* `Mail/Smtp`
* `Push/Fcm`
* `Storage/Database`

---

### `app/Contracts/`

Core contracts for developing custom channels and drivers:

* `BaseNotifierChannel`, `BaseDriver`, `BaseProcedure`, `BaseNotifierNotification`
* Ready-to-use traits like `FcmClient`, `KavenegarClient`, `SmsIrClient`, `DatabaseClient`

---

### `app/Resources/`

* `NotificationIndexResource`, `NotificationShowResource` – API resources for notification responses

---

## 🚀 Features

* Fully decoupled from Laravel’s default notification system
* Easily extendable to new channels (e.g., WhatsApp, Telegram, etc.)
* Fully asynchronous via queued jobs
* Supports sending to multiple recipients concurrently
* Database-based storage for user-visible notifications
