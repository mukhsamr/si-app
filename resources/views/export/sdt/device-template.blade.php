<table>
    <thead>
        <tr>
            <th>ID Siswa</th>
            <th>ID Laptop</th>
            <th>ID HP</th>
            <th>Siswa</th>
            <th>NIS</th>
            <th>Nama Laptop</th>
            <th>UID Laptop</th>
            <th>Nama HP</th>
            <th>UID HP</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->devices->where('type', 1)->first()?->id }}</td>
            <td>{{ $student->devices->where('type', 0)->first()?->id }}</td>
            
            <td>{{ $student->name }}</td>
            <td>{{ $student->nis }}</td>
            <td>{{ $student->devices->where('type', 1)->first()?->name }}</td>
            <td>{{ $student->devices->where('type', 1)->first()?->uid }}</td>
            <td>{{ $student->devices->where('type', 0)->first()?->name }}</td>
            <td>{{ $student->devices->where('type', 0)->first()?->uid }}</td>
        </tr>
        @endforeach
    </tbody>
</table>