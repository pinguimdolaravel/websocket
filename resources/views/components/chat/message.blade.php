@props([
    'message'
])
<div class="px-2 font-mono text-sm text-slate-400 flex justify-between hover:bg-slate-600 ">
    <div>
        <span class="font-semibold">{{ $message->user->username }}:</span>
        <span>{{ $message->message }}</span>
    </div>
    <span class="text-xs">({{ $message->created_at->diffForHumans() }})</span>
</div>
