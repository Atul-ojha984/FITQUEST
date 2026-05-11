const { pool } = require('./config');

module.exports = async (req, res) => {
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'POST, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');
  
  if (req.method === 'OPTIONS') {
    return res.status(200).end();
  }
  
  if (req.method !== 'POST') {
    return res.status(405).json({ error: 'Method not allowed' });
  }

  const { date, weight, workout_time, calories, mood, notes, user_id } = req.body || {};

  if (!date || !weight) {
    return res.status(400).json({ error: 'Missing required fields' });
  }

  try {
    const connection = await pool.getConnection();

    await connection.execute(
      'INSERT INTO progress (user_id, date, weight, workout_time, calories, mood, notes) VALUES (?, ?, ?, ?, ?, ?, ?)',
      [user_id || null, date, weight, workout_time || 0, calories || 0, mood || '', notes || '']
    );

    connection.release();
    return res.status(201).json({ success: true, message: 'Progress saved successfully' });
  } catch (error) {
    console.error('Save progress error:', error);
    return res.status(500).json({ error: 'Server error: ' + error.message });
  }
};
