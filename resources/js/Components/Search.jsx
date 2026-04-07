import { useForm, router } from '@inertiajs/react';
import { IconSearch } from '@tabler/icons-react';
import React from 'react'

export default function Search({ url, placeholder }) {

    // define use form inertia
    const params = new URLSearchParams(window.location.search);

    const { data, setData, get } = useForm({
        search: params.get('search') || '',
    })

    // define method searchData
    const handleSearchData = (e) => {
        e.preventDefault();
        get(`${url}?search=${data.search}`)
    }

    // define method clear search
    const handleClearSearch = () => {
        router.get(url); // Reset ke halaman utama (url tanpa parameter)
    }

    return (
        <form onSubmit={handleSearchData}>
            <div className='flex items-center gap-3'>
                <div className='relative w-full'>
                    <input
                        type='text'
                        value={data.search}
                        onChange={e => setData('search', e.target.value)}
                        className='py-2 px-4 pr-11 block w-full rounded-lg text-sm border focus:outline-none focus:ring-0 focus:ring-gray-400 text-gray-700 bg-white border-gray-200 focus:border-gray-200'
                        placeholder={placeholder} />
                    <div className='absolute inset-y-0 right-0 flex items-center pointer-events-none pr-4'>
                        <IconSearch size={18} strokeWidth={1.5} />
                    </div>
                </div>

                {data.search && (
                    <button
                        type="button"
                        onClick={handleClearSearch}
                        className="text-sm font-medium whitespace-nowrap text-gray-500 hover:text-red-500 transition-colors"
                    >
                        Clear Filter
                    </button>
                )}
            </div>
        </form>
    )
}
