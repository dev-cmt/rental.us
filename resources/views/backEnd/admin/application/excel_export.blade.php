<table>
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>SSN</th>
        <th>Birthday</th>
        <th>Address One</th>
        <th>Address Two</th>
        <th>City</th>
        <th>State</th>
        <th>Zip</th>
        <th>ID Type</th>
        <th>Front ID Image</th>
        <th>Back ID Image</th>
        <th>Selfie With ID</th>
        <th>Selfie</th>
    </tr>
    </thead>
    <tbody>
    @php
        // dd($data);
    @endphp
    @foreach ($data as $item)
        <tr>
            <td>{{ $item->first_name }}</td>
            <td>{{ $item->last_name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->phone }}</td>
            <td>{{ $item->social_security_num }}</td>
            <td>{{ date('d-M-Y', strtotime($item->birthday)) }}</td>
            <td>{{ $item->address_one }}</td>
            <td>{{ $item->address_two }}</td>
            <td>{{ $item->city }}</td>
            <td>{{ $item->state }}</td>
            <td>{{ $item->zip }}</td>
            <td>
                @if ($item->id_type == 1)
                    ID Card
                @elseif ($item->id_type == 2)
                    Passport
                @else
                    Driver;s License
                @endif
            </td>
            <td>
                <a href="{{ route('application.image.download', [$item->id, 'type' => 'id_front_image']) }}">
                    {{ str_replace('uploads/id_front_side_image/','',$item->id_front_image)  }}
                </a>
            </td>
            <td>
                <a href="{{ route('application.image.download', [$item->id, 'type' => 'id_back_image']) }}">
                    {{ str_replace('uploads/id_back_side_image/','',$item->id_back_image)  }}
                </a>
            </td>
            <td>
                <a href="{{ route('application.image.download', [$item->id, 'type' => 'face_selfie_with_id']) }}">
                    {{ str_replace('uploads/face_selfie_with_id/','',$item->face_selfie_with_id)  }}
                </a>
            </td>
            <td>
                <a href="{{ route('application.image.download', [$item->id, 'type' => 'face_selfie']) }}">
                    {{ str_replace('uploads/face_selfie/','',$item->face_selfie)  }}
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
