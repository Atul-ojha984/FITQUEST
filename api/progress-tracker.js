const { pool } = require('./config');

module.exports = async (req, res) => {
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'GET, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');
  
  if (req.method === 'OPTIONS') {
    return res.status(200).end();
  }
  
  if (req.method !== 'GET') {
    return res.status(405).json({ error: 'Method not allowed' });
  }

  try {
    const connection = await pool.getConnection();

    const [entries] = await connection.execute(
      'SELECT * FROM progress ORDER BY date DESC LIMIT 100'
    );

    connection.release();
    return res.status(200).json({ 
      success: true, 
      entries: entries 
    });
  } catch (error) {
    console.error('Get progress error:', error);
    return res.status(500).json({ error: 'Server error: ' + error.message });
  }
};
