<div>
    <!-- Well begun is half done. - Aristotle -->
    @props(['fullName'])

    @php
        $nameParts = explode(' ', $fullName);
        $lastName = end($nameParts);
    @endphp

    {{ $lastName }}

</div>
