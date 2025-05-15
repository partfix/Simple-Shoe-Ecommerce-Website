// Toast notif
function showToast(message, type = 'info') {
  const container = document.getElementById('toast-container');
  const id = 'toast-' + Date.now();

  let bgColor, iconPath, iconColor, borderColor, textColor;

  switch (type) {
    case 'success':
      bgColor = 'bg-emerald-50';
      iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />';
      iconColor = 'text-emerald-500';
      borderColor = 'border-emerald-400';
      textColor = 'text-emerald-800';
      break;
    case 'error':
      bgColor = 'bg-red-50';
      iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
      iconColor = 'text-red-500';
      borderColor = 'border-red-400';
      textColor = 'text-red-800';
      break;
    default:
      bgColor = 'bg-blue-50';
      iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />';
      iconColor = 'text-blue-500';
      borderColor = 'border-blue-400';
      textColor = 'text-blue-800';
  }

  const toast = document.createElement('div');
  toast.id = id;
  toast.classList.add('toast', 'mb-3', 'p-4', 'rounded-md', 'shadow-md', 'border-l-4', bgColor, borderColor, 'flex', 'items-start');

  toast.innerHTML = `
    <div class="flex-shrink-0 mr-3">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ${iconColor}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        ${iconPath}
      </svg>
    </div>
    <div class="flex-grow ${textColor} text-sm">
      ${message}
    </div>
    <div class="ml-auto pl-3 flex-shrink-0">
      <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" onclick="dismissToast('${id}')">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  `;

  container.appendChild(toast);


  setTimeout(() => {
    toast.classList.add('show');
  }, 10);


  setTimeout(() => {
    dismissToast(id);
  }, 5000);
}

function dismissToast(id) {
  const toast = document.getElementById(id);
  if (toast) {
    toast.classList.remove('show');
    setTimeout(() => {
      if (toast.parentNode) {
        toast.parentNode.removeChild(toast);
      }
    }, 400);
  }
}


