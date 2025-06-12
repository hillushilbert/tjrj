import React, { InputHTMLAttributes, useState } from 'react'

export default function Switcher({ onChangeEmit, checked, className = '', ...props }: {onChangeEmit: CallableFunction, checked: boolean} & InputHTMLAttributes<HTMLInputElement>) {

  const [isChecked, setIsChecked] = useState(checked)

  const handleCheckboxChange = () => {
    setIsChecked(!isChecked)
    onChangeEmit();
  }

  return (
    <>
      <label className='flex cursor-pointer select-none items-center'>
        <div className='relative'>
          <input
            {...props}
            checked={isChecked}
            onChange={handleCheckboxChange}
            type='checkbox'
            className='sr-only'
          />
          <div className={'block h-8 w-14 rounded-full ' + (isChecked ? 'bg-carrerablue-300' : 'bg-gray-300')}></div>
          <div className={'dot absolute left-1 top-1 h-6 w-6 rounded-full bg-white transition ' + (isChecked ? 'translate-x-full ': '') }></div>
        </div>
      </label>
    </>
  )
}
