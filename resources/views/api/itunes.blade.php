<h1>
  {{ $response->resultCount }} results
 </h1>
 
@foreach ($response->results as $result)
  <div style="background-color: #eee; margin: 10px; padding: 10px;">
    <div>
      Artist: {{ $result->artistName }}
    </div>
    <div>
      {{--
        ?? is called the null coalescing operator
        If it doesn't exist or is null, it returns a default value.
      --}}
      Track: {{ $result->trackName ?? 'NA' }}
    </div>
    <div>
      Album: {{ $result->collectionName }}
    </div>
  </div>
@endforeach