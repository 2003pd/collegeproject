<form method="POST" action="{{ route('admin.banner.update') }}">
    @csrf
    <input type="text" name="message" value="{{ $banner->message ?? '' }}">
    <input type="text" name="background_color" value="{{ $banner->background_color ?? 'bg-yellow-100' }}">
    <input type="checkbox" name="is_active" {{ $banner && $banner->is_active ? 'checked' : '' }}>
    <button>Save</button>
</form>
