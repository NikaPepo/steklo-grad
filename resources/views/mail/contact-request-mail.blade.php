<h1>Новая заявка</h1>

<p><strong>Имя:</strong> {{ $contact->name }}</p>
<p><strong>Телефон:</strong> {{ $contact->phone_number }}</p>
<p><strong>Дата:</strong> {{ $contact->created_at->timezone('Europe/Moscow')->translatedFormat('H:i, d F Y') }}</p>