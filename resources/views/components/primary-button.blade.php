<button {{ $attributes->merge(['type' => 'submit', 
    'class' => 'inline-flex items-center bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded ml-3' ]) }}>
    
    {{ $slot }}
</button>
